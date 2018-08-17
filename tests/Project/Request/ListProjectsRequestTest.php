<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Test\Project\Request;

use DateTime;
use DateTimeZone;
use Magneds\Lokalise\Project\Entity\Project;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\Project\Request\ListProjectsRequest;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\Test\AbstractTestCase;

class ListProjectsRequestTest extends AbstractTestCase
{
    public function testRequestArguments()
    {
        $request = new ListProjectsRequest();

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('project/list', $request->getURI());
        $this->assertEmpty($request->getBody());
    }

    public function testResponse()
    {
        $request = new ListProjectsRequest();

        $responseMock = $this->buildResponseMock('{"projects":[{"id":"2178052454e5eecbe36c68.09719217","name":"Sample Project","desc":"Lokalise sample project.","created":"2015-02-05 23:14:05","owner":"0"},{"id":"1412623154e5ef27b06bb2.34713953","name":"Demo Project","desc":"","created":"2015-02-19 16:11:51","owner":"1"}],"response":{"status":"success","code":"200","message":"OK"}}');

        $expected = [
            $this->buildProjectObject('2178052454e5eecbe36c68.09719217', 'Sample Project', 'Lokalise sample project.', '2015-02-05 23:14:05', 0),
            $this->buildProjectObject('1412623154e5ef27b06bb2.34713953', 'Demo Project', '', '2015-02-19 16:11:51', 1),
        ];

        $response = $request->handleResponse($responseMock);

        $this->assertInstanceOf(ResponseInfo::class, $response);
        $this->assertEquals($expected, $response->getActionData());
    }

    protected function buildProjectObject(
        $projectID,
        $name,
        $description,
        $dateTimeString,
        $owner
    ) {
        return new Project(
            new ProjectID($projectID),
            $name,
            $description,
            DateTime::createFromFormat('Y-m-d H:i:s', $dateTimeString, new DateTimeZone('Europe/Amsterdam')),
            $owner
        );
    }
}
