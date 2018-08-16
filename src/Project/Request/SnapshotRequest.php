<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Project\Request;

use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Psr\Http\Message\ResponseInterface;

class SnapshotRequest implements RequestInterface
{
    /**
     * @var ProjectID
     */
    protected $projectID;

    /**
     * @var string|null
     */
    protected $title;

    /**
     * SnapshotRequest constructor.
     * @param ProjectID $projectID
     * @param null|string $title
     */
    public function __construct(ProjectID $projectID, $title = null)
    {
        $this->projectID = $projectID;
        $this->title     = $title;
    }

    /**
     * Return the method to make this request in.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'POST';
    }

    /**
     * This URI is appended to the route URL given to the Client object.
     *
     * @return string
     */
    public function getURI()
    {
        return 'project/snapshot';
    }

    /**
     * @return array
     */
    public function getQueryArguments()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getBody()
    {
        $body = [
            'id' => $this->projectID->getID(),
        ];

        if(!is_null($this->title)) {
            $body['title'] = $this->title;
        }

        return $body;
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function handleResponse(ResponseInterface $response): ResponseInfo
    {
        $responseData = json_decode($response->getBody()->getContents(), true);
        $responseInfo = ResponseInfo::buildFromArray($responseData['response']);

        return $responseInfo;
    }
}
