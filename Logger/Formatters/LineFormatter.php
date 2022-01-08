<?php

namespace Logger\Formatters;

use Logger\Collection\Collection;
use Logger\Formatters\Replacers\DateReplacer;
use Logger\Formatters\Replacers\IReplacer;
use Logger\Formatters\Replacers\LevelCodeReplacer;
use Logger\Formatters\Replacers\LevelReplacer;
use Logger\Formatters\Replacers\MessageReplacer;

class LineFormatter implements ILineFormatter
{
    public const DEFAULT_FORMAT = "%date% %level_code% %level% %message%";

    protected string $format;

    protected ?string $dateFormat;

    /**
     * Replacements present name
     * @var Collection<IReplacer>
     */
    protected Collection $replacements;

    public const DATE_NAME = '%date%';
    public const LEVEL_CODE = '%level_code%';
    public const LEVEL = '%level%';
    public const MESSAGE = '%message%';

    public function __construct(?string $format = null, ?string $dateFormat = null)
    {
        $this->format = $format ?? self::DEFAULT_FORMAT;
        $this->dateFormat = $dateFormat;
        $this->replacements = new Collection();
    }

    public function formatMessage(string $message, Collection $level): string
    {
        $this->generateFormatters($message, $level);

        $message = $this->replaceMessage();

        $this->replacements->empty();

        return $message;
    }

    public function generateFormatters(string $message, Collection $level): void
    {
        if(!preg_match_all('@%[^%]*%@', $this->format, $matches) && !isset($matches[0]))
        {
            return;
        }
        $matches = $matches[0];

        if(in_array(self::DATE_NAME, $matches)){
            $this->replacements->add(new DateReplacer($this->dateFormat));
        }
        if(in_array(self::LEVEL_CODE, $matches))
        {
            $this->replacements->add(new LevelCodeReplacer($level->get('code')));
        }
        if(in_array(self::LEVEL, $matches))
        {
            $this->replacements->add(new LevelReplacer($level->get('name')));
        }
        if(in_array(self::MESSAGE, $matches))
        {
            $this->replacements->add(new MessageReplacer($message));
        }
    }

    public function replaceMessage(): string
    {
        $message = $this->format;

        $this->replacements->map(function ($replacer) use (&$message) {
            /** @var $replacer IReplacer */
            $message = $replacer->replace($message);
        });

        return $message;
    }
}