<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise;

use Psr\Http\Message\ResponseInterface;

interface RequestInterface
{
    /**
     * Return the method to make this request in.
     *
     * @return string
     */
    public function getMethod();

    /**
     * This URI is appended to the route URL given to the Client object.
     *
     * @return string
     */
    public function getURI();

    /**
     * @return array
     */
    public function getQueryArguments();

    /**
     * @return array
     */
    public function getBody();

    /**
     * @param ResponseInterface $response
     * @return ResponseInfo
     */
    public function handleResponse(ResponseInterface $response) : ResponseInfo;
}
