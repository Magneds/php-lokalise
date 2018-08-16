<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Language\Request;

use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Psr\Http\Message\ResponseInterface;
use function json_decode;

class AddLanguageRequest implements RequestInterface
{
    /**
     * @var ProjectID
     */
    protected $projectID;

    /**
     * @var Language[]
     */
    protected $languages;

    /**
     * AddLanguageRequest constructor.
     * @param ProjectID $projectID
     * @param Language[] $languages
     */
    public function __construct(ProjectID $projectID, array $languages)
    {
        $this->projectID = $projectID;
        $this->languages = $languages;
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
        return 'language/add';
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
        $languages = [];

        foreach($this->languages as $language) {
            $languages[] = $language->getIso();
        }

        return [
            'id' => $this->projectID->getID(),
            'iso' => $languages
        ];
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function handleResponse(ResponseInterface $response): ResponseInfo
    {
        $responseData = json_decode($response->getBody()->getContents(), true);
        return ResponseInfo::buildFromArray($responseData['response']);
    }
}
