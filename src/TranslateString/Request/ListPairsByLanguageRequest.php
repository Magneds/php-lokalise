<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\TranslateString\Request;

use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\TranslateString\Entity\LanguageTranslateStringCollection;
use Magneds\Lokalise\TranslateString\Entity\TranslateString;
use Psr\Http\Message\ResponseInterface;

class ListPairsByLanguageRequest implements RequestInterface
{
    /**
     * @var ProjectID
     */
    protected $projectID;

    /**
     * @var Language[]
     */
    protected $languages;

    const PLATFORM_IOS     = 1;
    const PLATFORM_ANDROID = 2;
    const PLATFORM_WEB     = 4;
    const PLATFORM_OTHER   = 16;

    protected $platformMask;


    public function __construct(ProjectID $projectID, array $languages = [])
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
        return 'string/list';
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

        if (!empty($this->languages)) {
            $body['langs'] = $this->getLanguageISOCodes();
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

        if ($responseInfo->getCode() !== 200) {
            return $responseInfo;
        }

        $languageStringCollections = [];
        foreach ($responseData['strings'] as $lang => $strings) {

            $translateStrings = [];
            foreach ($strings as $string) {
                $translateStrings[] = TranslateString::buildFromArray($string);
            }

            $languageStringCollections[] = new LanguageTranslateStringCollection($lang, ...$translateStrings);
        }

        // Add it to the response object.
        $responseInfo->setActionData($languageStringCollections);

        return $responseInfo;
    }

    protected function getLanguageISOCodes()
    {
        return array_map(function (Language $lang) {
            return $lang->getIso();
        }, $this->languages);
    }
}
