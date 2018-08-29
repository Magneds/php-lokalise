<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\TranslateString\Entity;

use Magneds\Lokalise\Language\Entity\Language;

class TranslateStringPartial
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var int|null
     */
    protected $platformMask;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string[]
     */
    protected $tags;

    /**
     * @var string[]
     */
    protected $translations;

    /**
     * TranslateStringPartial constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return int|null
     */
    public function getPlatformMask()
    {
        return $this->platformMask;
    }

    /**
     * @param int $platformMask
     * @return $this
     */
    public function setPlatformMask($platformMask)
    {
        $this->platformMask = (int)$platformMask;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = (string)$description;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string[] $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->tags = (array)$tags;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function addTranslation(Language $language, $translation)
    {
        $isoLang = $language->getIso();

        if(!array_key_exists($isoLang, $this->translations)) {
            $this->translations[$isoLang] = [];
        }

        $this->translations[$isoLang][] = $translation;
    }

    public function toArray()
    {
        $data = [
            'key' => $this->key,
            'platform_mask' => $this->platformMask,
            'description' => $this->description,
            'tags' => $this->tags,
            'translations' => $this->translations
        ];

        return array_filter($data);
    }
}
