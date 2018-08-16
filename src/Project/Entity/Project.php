<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Project\Entity;

use DateTime;
use DateTimeZone;

class Project
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var DateTime
     */
    protected $created;

    /**
     * @var int
     */
    protected $owner;

    /**
     * Project constructor.
     * @param string $id
     * @param string $name
     * @param string $description
     * @param DateTime $created
     * @param int $owner
     */
    public function __construct(ProjectID $id, string $name, string $description, DateTime $created, int $owner)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->created     = $created;
        $this->owner       = $owner;
    }

    /**
     * @return string
     */
    public function getID(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @return int
     */
    public function getOwner(): int
    {
        return $this->owner;
    }

    public static function buildFromArray($array)
    {
        $timezone = new DateTimeZone('Europe/Amsterdam');
        $utc      = new DateTimeZone('UTC');

        $created = DateTime::createFromFormat('Y-m-d H:i:s', $array['created'], $timezone);
        $created->setTimezone($utc);

        return new Project(new ProjectID($array['id']), $array['name'], $array['desc'], $created, $array['owner']);
    }
}
