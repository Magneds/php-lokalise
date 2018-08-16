<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise;

use function array_key_exists;

class ResponseInfo
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var mixed
     */
    protected $actionData;

    /**
     * ResponseInfo constructor.
     * @param string $status
     * @param int $code
     * @param string $message
     */
    public function __construct(string $status, int $code, string $message)
    {
        $this->status  = $status;
        $this->code    = $code;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    public function setActionData($actionData)
    {
        $this->actionData = $actionData;
        return $this;
    }

    public function getActionData()
    {
        return $this->actionData;
    }

    /**
     * Build this object with data array typically from the responses json.
     *
     * @param array $array
     * @return self
     */
    public static function buildFromArray($array)
    {
        $status  = array_key_exists('status', $array) ? $array['status'] : '';
        $code    = array_key_exists('code', $array) ? (int)$array['code'] : 0;
        $message = array_key_exists('message', $array) ? $array['message'] : '';

        return new self($status, $code, $message);
    }
}
