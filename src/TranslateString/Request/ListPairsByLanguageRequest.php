<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\TranslateString\Request;

use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\RequestInterface;
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



        return $body;
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function handleResponse(ResponseInterface $response)
    {
        // TODO: Implement handleResponse() method.
    }

}
