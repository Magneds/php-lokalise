<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Project\Request;

use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Psr\Http\Message\ResponseInterface;

class AddProjectRequest implements RequestInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $baseLang;

    /**
     * AddProjectRequest constructor.
     * @param string $name
     * @param string $description
     * @param string $baseLang
     */
    public function __construct(string $name, string $description, string $baseLang)
    {
        $this->name        = $name;
        $this->description = $description;
        $this->baseLang    = $baseLang;
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
        return 'project/add';
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
        return [
            'name'        => $this->name,
            'description' => $this->description,
            'base_lang'   => $this->baseLang
        ];
    }

    /**
     * @param ResponseInterface $response
     * @return ProjectID
     */
    public function handleResponse(ResponseInterface $response): ResponseInfo
    {
        $responseData = json_decode($response->getBody()->getContents(), true);
        $responseInfo = ResponseInfo::buildFromArray($responseData['response']);

        // Would be expecting 201 here.
        if($responseInfo->getCode() !== 200) {
            return $responseInfo;
        }

        $responseInfo->setActionData(new ProjectID($responseData['project']['id']));

        return $responseInfo;
    }
}
