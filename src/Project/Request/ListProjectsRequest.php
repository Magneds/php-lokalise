<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Project\Request;

use DateTime;
use DateTimeZone;
use Magneds\Lokalise\Project\Entity\Project;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Psr\Http\Message\ResponseInterface;

class ListProjectsRequest implements RequestInterface
{
    /**
     * Return the method to make this request in.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'GET';
    }

    /**
     * This URI is appended to the route URL given to the Client object.
     *
     * @return string
     */
    public function getURI()
    {
        return 'project/list';
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
        return [];
    }

    /**
     * @param ResponseInterface $response
     * @return ResponseInfo
     */
    public function handleResponse(ResponseInterface $response): ResponseInfo
    {
        $responseData = json_decode($response->getBody()->getContents(), true);
        $responseInfo = ResponseInfo::buildFromArray($responseData['response']);

        if($responseInfo->getCode() !== 200) {
            return $responseInfo;
        }

        $projects  = [];
        foreach($responseData['projects'] as $project) {
            $projects[] = Project::buildFromArray($project);
        }

        // Add it to the response object.
        $responseInfo->setActionData($projects);

        return $responseInfo;
    }
}
