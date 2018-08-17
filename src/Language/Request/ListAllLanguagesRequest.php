<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Language\Request;

use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\RequestInterface;
use Magneds\Lokalise\ResponseInfo;
use Psr\Http\Message\ResponseInterface;

class ListAllLanguagesRequest implements RequestInterface
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
        return 'language/listall';
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
     * @return mixed
     */
    public function handleResponse(ResponseInterface $response): ResponseInfo
    {
        $responseData = json_decode($response->getBody()->getContents(), true);
        $responseInfo = ResponseInfo::buildFromArray($responseData['response']);

        if ($responseInfo->getCode() !== 200) {
            return $responseInfo;
        }

        $languages = [];
        foreach ($responseData['languages'] as $language) {
            $languages[] = new Language($language['iso'], $language['name'], $language['rtl'] === "1");
        }

        $responseInfo->setActionData($languages);
        return $responseInfo;
    }
}
