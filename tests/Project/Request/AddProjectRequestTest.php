<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Test\Project\Request;

use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\Project\Request\AddProjectRequest;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\Test\AbstractTestCase;

class AddProjectRequestTest extends AbstractTestCase
{
    public function testBasicArguments()
    {
        $request = new AddProjectRequest('Testing name', 'Testing Description', 'en_GB');

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('project/add', $request->getURI());

        $expectedBody = [
            'name' => 'Testing name',
            'description' => 'Testing Description',
            'base_lang' => 'en_GB',
        ];

        $this->assertEquals($expectedBody, $request->getBody());
    }

    public function testResponse()
    {
        $request = new AddProjectRequest('Testing name', 'Testing Description', 'en_GB');

        $responseMock = $this->buildResponseMock('{"project":{"id":"2178052454e5eecbe36c68.09719217"},"response":{"status":"success","code":"200","message":"OK"}}');

        $return = $request->handleResponse($responseMock);

        $this->assertInstanceOf(ResponseInfo::class, $return);
        $this->assertInstanceOf(ProjectID::class, $return->getActionData());
        $this->assertEquals('2178052454e5eecbe36c68.09719217', $return->getActionData()->getID());
    }
}
