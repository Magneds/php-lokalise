<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Test\Language\Request;

use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\Language\Request\ListAllLanguagesRequest;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\Test\AbstractTestCase;

class ListAllLanguagesRequestTest extends AbstractTestCase
{
    public function testBasicArguments()
    {
        $request = new ListAllLanguagesRequest();

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('language/listall', $request->getURI());
    }

    public function testResponse()
    {
        $request = new ListAllLanguagesRequest();

        $responseMock = $this->buildResponseMock('{"languages":[{"iso":"en","name":"English","rtl":"0"},{"iso":"en_US","name":"English (United States)","rtl":"0"}],"response":{"status":"success","code":"200","message":"OK"}}');

        $return = $request->handleResponse($responseMock);

        $languages = $return->getActionData();

        $expected = [
            $this->buildLanguageObject('en', 'English', false),
            $this->buildLanguageObject('en_US', 'English (United States)', false)
        ];

        $this->assertInstanceOf(ResponseInfo::class, $return);
        $this->assertEquals($expected, $languages);
    }

    protected function buildLanguageObject($iso, $name, $rtl)
    {
        return new Language($iso, $name, $rtl);
    }
}
