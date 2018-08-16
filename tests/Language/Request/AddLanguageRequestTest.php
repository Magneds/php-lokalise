<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Test\Language\Request;

use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\Language\Request\AddLanguageRequest;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\Test\AbstractTestCase;

class AddLanguageRequestTest extends AbstractTestCase
{
    /**
     * @var AddLanguageRequest
     */
    public $request;

    public function setUp()
    {
        $this->request = new AddLanguageRequest(
            new ProjectID('abcdef'),
            [
                new Language('en_GB', 'English (Great Britain)', false)
            ]
        );
    }

    public function testBasicArguments()
    {
        $this->assertEquals('POST', $this->request->getMethod());
        $this->assertEquals('language/add', $this->request->getURI());
    }

    public function testResponse()
    {
        $responseMock = $this->buildResponseMock('{"response":{"status":"success","code":"200","message":"OK"}}');

        $return = $this->request->handleResponse($responseMock);

        $this->assertInstanceOf(ResponseInfo::class, $return);
        $this->assertEquals(200, $return->getCode());
    }
}
