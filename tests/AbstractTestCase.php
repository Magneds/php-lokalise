<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Test;

use Magneds\Lokalise\ResponseInfo;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractTestCase extends TestCase
{
    public function buildResponseMock($responseJson)
    {
        $stream = $this->getMockBuilder(StreamInterface::class)->getMock();
        $stream
            ->method('getContents')
            ->willReturn($responseJson);

        $responseMock = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $responseMock
            ->method('getBody')
            ->willReturn($stream);

        return $responseMock;
    }

    protected function buildResponseInfoMock($status = "success", $code = 200, $message = "OK")
    {
        // Build the object
        $responseInfo = $this->getMockBuilder(ResponseInfo::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock responses
        $responseInfo->method('getStatus')->willReturn($status);
        $responseInfo->method('getCode')->willReturn($code);
        $responseInfo->method('getMessage')->willReturn($message);

        return $responseInfo;
    }
}
