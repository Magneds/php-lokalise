<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\TranslateString\Entity;

class Result
{
    /**
     * @var int
     */
    protected $inserted;

    /**
     * @var int
     */
    protected $updated;

    /**
     * Result constructor.
     * @param int $inserted
     * @param int $updated
     */
    public function __construct(int $inserted, int $updated)
    {
        $this->inserted = $inserted;
        $this->updated  = $updated;
    }

    /**
     * @return int
     */
    public function getInserted(): int
    {
        return $this->inserted;
    }

    /**
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * @param $data
     * @return Result
     */
    public static function buildFromArray($data)
    {
        $inserted = array_key_exists('inserted', $data) ? $data['inserted'] : 0;
        $updated = array_key_exists('updated', $data) ? $data['updated'] : 0;

        return new self($inserted, $updated);
    }
}
