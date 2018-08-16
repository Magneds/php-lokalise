<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
use GuzzleHttp\Client;
use Magneds\Lokalise\Client\LokaliseClient;
use Magneds\Lokalise\Project\Request\AddProjectRequest;
use Magneds\Lokalise\Project\Request\ListProjectsRequest;

require_once __DIR__ . "/vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$client = new LokaliseClient('c0f6592d352cd001af26ec27c1cdb92652a90daa');

$response = $client->send(new ListProjectsRequest());
#$response = $client->send(new AddProjectRequest('Testing API', 'Testing submitting from API', 'en_GB'));
dump($response);
