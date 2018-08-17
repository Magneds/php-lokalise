<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\TranslateString\Entity;

use Magneds\Lokalise\Language\Entity\Language;

class LanguageTranslateStringCollection
{
    /**
     * @var string
     */
    protected $iso;

    /**
     * @var TranslateString[]
     */
    protected $strings;

    public function __construct(string $iso, TranslateString ...$strings)
    {
        $this->iso = $iso;
        $this->strings = $strings;
    }

    public function getTranslateStrings(): array
    {
        return $this->strings;
    }

    public function getLanguage(): string
    {
        return $this->iso;
    }
}
