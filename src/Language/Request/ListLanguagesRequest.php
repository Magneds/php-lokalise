<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Language\Request;

use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\Language\Entity\ProjectLanguage;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Psr\Http\Message\ResponseInterface;

class ListLanguagesRequest implements RequestInterface
{
    /**
     * @var ProjectID
     */
    protected $projectID;

    /**
     * ListLanguagesRequest constructor.
     * @param ProjectID $projectID
     */
    public function __construct(ProjectID $projectID)
    {
        $this->projectID = $projectID;
    }

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
        return 'language/list';
    }

    /**
     * @return array
     */
    public function getQueryArguments()
    {
        return [
            'id' => $this->projectID->getID(),
        ];
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
     * @return mixed
     */
    public function handleResponse(ResponseInterface $response): ResponseInfo
    {
        $responseData = json_decode($response->getBody()->getContents(), true);

        $languages = [];
        foreach ($responseData['languages'] as $projectLanguage) {
            $languages[] = new ProjectLanguage(
                new Language($projectLanguage['iso'], $projectLanguage['name'], $projectLanguage['rtl'] === "1"),
                (int)$projectLanguage['words'],
                $projectLanguage['is_default'] === "1"
            );
        }

        return $languages;
    }
}
