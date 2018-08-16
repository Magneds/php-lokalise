<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Test\Project\Request;

use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\Project\Request\SnapshotRequest;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\Test\AbstractTestCase;

class SnapshotRequestTest extends AbstractTestCase
{
    public function testRequestArgumentsWithoutTitle()
    {
        $request = new SnapshotRequest(new ProjectID('2178052454e5eecbe36c68.09719217'));

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('project/snapshot', $request->getURI());
        $this->assertSame([
            'id' => '2178052454e5eecbe36c68.09719217'
        ], $request->getBody());
    }

    public function testRequestArgumentsWithTitle()
    {
        $request = new SnapshotRequest(new ProjectID('2178052454e5eecbe36c68.09719217'), 'Backup 20180101155000');

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('project/snapshot', $request->getURI());
        $this->assertSame([
            'id' => '2178052454e5eecbe36c68.09719217',
            'title' => 'Backup 20180101155000',
        ], $request->getBody());
    }

    public function testResponse()
    {
        $request = new SnapshotRequest(new ProjectID('2178052454e5eecbe36c68.09719217'));

        $response = $request->handleResponse($this->buildResponseMock('{"response":{"status":"success","code":"200","message":"OK"}}'));

        $this->assertInstanceOf(ResponseInfo::class, $response);
        $this->assertEquals(200, $response->getCode());
    }
}
