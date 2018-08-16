# magneds/lokalise
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A lokalise.co API library. Used to integrate with [https://lokalise.co](https://lokalise.co).

__Still in very active development. Major changes may happen between commits.__ 

__Please wait for the first tag before use__

## Install
Via Composer

```bash
$ composer require magneds/lokalise
```

## Usage

```php
$client = new Magneds\Lokalise\Client\LokaliseClient('API_KEY');

/** @var Project[] $response */
$response = $client->send(new Magneds\Project\Request\ListProjectsRequest());
```

## Table of Support
If you want an idea on what you can help with, below is the graph of supported API endpoints as detailed
from: [https://lokalise.co/apidocs](https://lokalise.co/apidocs)

|Projects|Status|
|---|---|
|[List](https://lokalise.co/apidocs#ls_projects)|[ListProjectsRequest](src/Project/Request/ListProjectsRequest.php)|
|[Add](https://lokalise.co/apidocs#add_project)|[AddProjectRequest](src/Project/Request/AddProjectRequest.php)|
|[Remove](https://lokalise.co/apidocs#rm_project)||
|[Import to project](https://lokalise.co/apidocs#import)||
|[Export from project](https://lokalise.co/apidocs#export)||
|[Upload screenshot](https://lokalise.co/apidocs#screenshot)||
|[Snapshot](https://lokalise.co/apidocs#snapshot)|[Snapshot](src/Project/Request/SnapshotRequest.php)|
|[Empty](https://lokalise.co/apidocs#empty)||

|Languages|Status|
|---|---|
|[List system languages](https://lokalise.co/apidocs#ls_syslangs)|[ListAllLanguagesRequest](src/Language/Request/ListAllLanguagesRequest.php)|
|[List](https://lokalise.co/apidocs#ls_langs)|[ListLanguagesRequest](src/Language/Request/ListLanguagesRequest.php)|
|[Add](https://lokalise.co/apidocs#add_langs)|[AddLanguageRequest](src/Language/Request/AddLanguageRequest.php)|
|[Set properties](https://lokalise.co/apidocs#set_lang)||
|[Remove](https://lokalise.co/apidocs#rm_langs)||

|Strings|Status|
|---|---|
|[List pairs by language](https://lokalise.co/apidocs#ls_strings)|[ListPairsByLanguageRequest](src/TranslateString/Request/ListPairsByLanguageRequest.php)|
|[Add or update](https://lokalise.co/apidocs#set)||
|[Remove keys with translations](https://lokalise.co/apidocs#rm_keys)||


##### Useful links
- [Intro](https://lokalise.co/apidocs#intro)
- [File formats](https://lokalise.co/apidocs#file_formats)
- [Plurals and placeholders](https://lokalise.co/apidocs#pl_ph_formats)
- [Error Codes](https://lokalise.co/apidocs#errors)



## Change log

## Testing
```bash
$ composer test
```

## Contributing

Please see [Contributing](CONTRIBUTING.md)


## Credits

- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
