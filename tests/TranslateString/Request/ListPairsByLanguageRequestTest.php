<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Test\TranslateString\Request;

use DateTime;
use DateTimeZone;
use Magneds\Lokalise\Language\Entity\Language;
use Magneds\Lokalise\Project\Entity\ProjectID;
use Magneds\Lokalise\ResponseInfo;
use Magneds\Lokalise\Test\AbstractTestCase;
use Magneds\Lokalise\TranslateString\Entity\LanguageTranslateStringCollection;
use Magneds\Lokalise\TranslateString\Entity\TranslateString;
use Magneds\Lokalise\TranslateString\Request\ListPairsByLanguageRequest;

class ListPairsByLanguageRequestTest extends AbstractTestCase
{
    public function testRequestArgumentsWithoutLanguages()
    {
        $projectID = new ProjectID('2178052454e5eecbe36c68.09719217');
        $request = new ListPairsByLanguageRequest($projectID);

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('string/list', $request->getURI());
        $this->assertEquals(
            [
                'id' => $projectID->getID()
            ],
            $request->getBody()
        );
    }

    public function testRequestArgumentsWithLanguages()
    {
        $projectID = new ProjectID('2178052454e5eecbe36c68.09719217');
        $languages = [new Language('nl', 'Dutch', true), new Language('en', 'English', true)];
        $request = new ListPairsByLanguageRequest($projectID, $languages);

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('string/list', $request->getURI());
        $this->assertEquals(
            [
                'id' => $projectID->getID(),
                'langs' => ['nl', 'en']
            ],
            $request->getBody()
        );
    }

    public function testResponse()
    {
        $projectID = new ProjectID('2178052454e5eecbe36c68.09719217');
        $request = new ListPairsByLanguageRequest($projectID);

        $responseMock = $this->buildResponseMock('{"strings":{"en":[{"key":"appstore.app.title","translation":"Lokalise","plural_key":null,"platform_mask":16,"is_hidden":"0","created_at":"2015-02-05 23:14:58","tags":[],"modified_at":"2015-02-05 23:21:20","fuzzy":"0","context":null,"is_archived":"0"},{"key":"index.welcome","translation":"Joined string, for on iOS and Android","plural_key":null,"platform_mask":"3","is_hidden":"0","created_at":"2015-02-05 23:17:27","tags":["tag 1","tag 2","tag 3"],"modified_at":"2015-02-05 23:17:27","fuzzy":"0","context":null,"is_archived":"0"}]},"response":{"status":"success","code":"200","message":"OK"}}');

        $expected = [
            new LanguageTranslateStringCollection(
                'en',
                new TranslateString(
                    'appstore.app.title',
                    'Lokalise',
                    null,
                    16,
                    false,
                    [],
                    false,
                    null,
                    false,
                    DateTime::createFromFormat('Y-m-d H:i:s', "2015-02-05 23:21:20", new DateTimeZone('Europe/Amsterdam')),
                    DateTime::createFromFormat('Y-m-d H:i:s', "2015-02-05 23:14:58", new DateTimeZone('Europe/Amsterdam'))
                ),
                new TranslateString(
                    'index.welcome',
                    'Joined string, for on iOS and Android',
                    null,
                    3,
                    false,
                    ["tag 1", "tag 2", "tag 3"],
                    false,
                    null,
                    false,
                    DateTime::createFromFormat('Y-m-d H:i:s', "2015-02-05 23:17:27", new DateTimeZone('Europe/Amsterdam')),
                    DateTime::createFromFormat('Y-m-d H:i:s', "2015-02-05 23:17:27", new DateTimeZone('Europe/Amsterdam'))
                )
            )
        ];
        $response = $request->handleResponse($responseMock);

        $this->assertInstanceOf(ResponseInfo::class, $response);
        $this->assertEquals($expected, $response->getActionData());
    }
}
