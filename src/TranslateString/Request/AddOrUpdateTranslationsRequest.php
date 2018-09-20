<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\TranslateString\Request;

use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\TranslateString\Entity\Result;
use Magneds\Lokalise\TranslateString\Entity\TranslateStringPartial;
use Psr\Http\Message\ResponseInterface;

class AddOrUpdateTranslationsRequest implements RequestInterface
{
    /**
     * @var ProjectID
     */
    protected $projectID;

    /**
     * @var TranslateStringPartial[]
     */
    protected $data = [];

    /**
     * AddOrUpdateTranslationsRequest constructor.
     * @param ProjectID $projectID
     */
    public function __construct(ProjectID $projectID)
    {
        $this->projectID = $projectID;
    }

    public function addData(TranslateStringPartial $partial)
    {
        $this->data[] = $partial;
        return $this;
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
        return 'string/set';
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
        $data = [];
        foreach ($this->data as $partial) {
            $data[] = $partial->toArray();
        }

        var_dump($data);
        $d = [
            'id'   => $this->projectID->getID(),
            'data' => json_encode($data)
        ];

        return $d;
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

        $responseInfo->setActionData(Result::buildFromArray($responseData['result']));
        return $responseInfo;
    }
}
