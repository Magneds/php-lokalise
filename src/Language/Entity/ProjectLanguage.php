<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Language\Entity;

class ProjectLanguage
{
    /**
     * @var Language
     */
    protected $language;

    /**
     * @var int
     */
    protected $words;

    /**
     * @var boolean
     */
    protected $default;

    /**
     * ProjectLanguage constructor.
     * @param Language $language
     * @param int $words
     * @param bool $default
     */
    public function __construct(Language $language, int $words, bool $default)
    {
        $this->language = $language;
        $this->words    = $words;
        $this->default  = $default;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @return int
     */
    public function getWords(): int
    {
        return $this->words;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }
}
