<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\TranslateString\Entity;

use DateTime;
use DateTimeZone;

class TranslateString
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $translation;

    /**
     * @var string|null
     */
    protected $pluralKey;

    /**
     * @var int
     */
    protected $platformMask;

    /**
     * @var boolean
     */
    protected $hidden;

    /**
     * @var array
     */
    protected $tags;

    /**
     * @var boolean
     */
    protected $fuzzy;

    /**
     * @var string|null
     */
    protected $context;

    /**
     * @var boolean
     */
    protected $archived;

    /**
     * @var DateTime
     */
    protected $modified;

    /**
     * @var DateTime
     */
    protected $created;

    /**
     * TranslateString constructor.
     * @param string $key
     * @param string $translation
     * @param null|string $pluralKey
     * @param int $platformMask
     * @param bool $hidden
     * @param array $tags
     * @param bool $fuzzy
     * @param null|string $context
     * @param bool $archived
     * @param DateTime $modified
     * @param DateTime $created
     */
    public function __construct(
        string $key,
        string $translation,
        $pluralKey,
        int $platformMask,
        bool $hidden,
        array $tags,
        bool $fuzzy,
        $context,
        bool $archived,
        DateTime $modified,
        DateTime $created
    ) {
        $this->key          = $key;
        $this->translation  = $translation;
        $this->pluralKey    = $pluralKey;
        $this->platformMask = $platformMask;
        $this->hidden       = $hidden;
        $this->tags         = $tags;
        $this->fuzzy        = $fuzzy;
        $this->context      = $context;
        $this->archived     = $archived;
        $this->modified     = $modified;
        $this->created      = $created;
    }

    public static function buildFromArray($array)
    {
        $timezone = new DateTimeZone('Europe/Amsterdam');
        $utc      = new DateTimeZone('UTC');

        $created = DateTime::createFromFormat('Y-m-d H:i:s', $array['created_at'], $timezone);
        $created->setTimezone($utc);

        $modified = DateTime::createFromFormat('Y-m-d H:i:s', $array['modified_at'], $timezone);
        $modified->setTimezone($utc);

        return new TranslateString(
            $array['key'],
            $array['translation'],
            $array['plural_key'],
            $array['platform_mask'],
            (bool) $array['is_hidden'],
            $array['tags'],
            (bool) $array['fuzzy'],
            $array['context'],
            (bool) $array['is_archived'],
            $modified,
            $created
        );
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return $this->translation;
    }

    /**
     * @return null|string
     */
    public function getPluralKey(): string
    {
        return $this->pluralKey;
    }

    /**
     * @return int
     */
    public function getPlatformMask(): int
    {
        return $this->platformMask;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return bool
     */
    public function isFuzzy(): bool
    {
        return $this->fuzzy;
    }

    /**
     * @return null|string
     */
    public function getContext(): string
    {
        return $this->context;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @return DateTime
     */
    public function getModified(): DateTime
    {
        return $this->modified;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }
}
