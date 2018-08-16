<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Magneds\Lokalise\RequestInterface;

class LokaliseClient
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * LokaliseClient constructor.
     * @param ClientInterface $client
     * @param string $apiKey
     */
    public function __construct(string $apiKey, ClientInterface $client = null)
    {
        $this->apiKey = $apiKey;

        if (is_null($client)) {
            $client = new Client([
                'base_uri' => 'https://api.lokalise.co/api/',
            ]);
        }

        $this->client = $client;
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(RequestInterface $request)
    {
        $method = $request->getMethod();
        $uri    = $request->getURI();

        $options = [
            'query'       => ['api_token' => $this->apiKey],
            'form_params' => array_merge(['api_token' => $this->apiKey], $request->getBody()),
        ];

        $response = $this->client->request(
            $method,
            $uri,
            $options
        );

        return $request->handleResponse($response);
    }
}
