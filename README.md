# TestTaker API

## Summary

Coding Interview task for OnePoint Ltd.

> The goal of the exercise is to create a list of test takers (test takers can be seen as users). You are free to use the libraries/frameworks you want as soon as the code created by yourself and the code created by other can be distinguished.
 
> _Backend (PHP)_. Create a REST service that returns a list of _test takers_. You have 2 files (`testtaker.json` and `testtaker.csv`)  which contain data and should be used as data sources.

> Note: the service should read data from different storages (json, csv, etc) and expose data to different formats (json, xml, etc).
> Nice to have: The component should be reused to display other kind of data. 

## Bootstrapping

Run docker composer:

```bash
docker-compose up -d
```

Add `api.tasty.localhost` record to your hosts file:

```bash
127.0.0.1 api.tasty.localhost
```

## Application

Application uses multiple providers as data source. Type of response is resolved dynamically based on url parameter.

Resource is available at `http://api.tasty.localhost/test-takers.json`

 
### Providers

Storage is the object with responsibility of loading `TestTakers` from different files (json, txt, etc.) or another places.
Each of them must implement `TestTakerProviderInterface` to be replaceable in the system. 

#### JSON, XML providers

Out of the box implemented JSON and XML providers. You can use them separately as services or as a part of `ChainedTestTakerProvider`.

To use it, you need to alias TestTakerProviderInterface as one of the providers:
```yaml
services:
    Tasty\Provider\TestTakerProviderInterface: '@tasty.taker_provider.chained'
```

#### Chained provider

`ChainedTestTakerProvider` utilizes all storages, that are defined as services and tagged with ``test_taker.provider`` tag.
When asked to load items, it iterates over all tagged providers and merges result into one collection.
To remove provider from the chain, just untag it.  

#### Custom provider

To add custom storage, implement your own `TestTakerProviderInterface` interface and tag this service with `test_taker.provider` tag:

```php
class CustomTestTakerProvider implements TestTakerProviderInterface
{
    /**
     * @return TestTaker[]
     */
    public function load(): array
    {
        // ...
    }
}
```

```yaml
services:

    tasty.taker_provider.custom:
        class: Tasty\Provider\CustomTestTakerProvider
        arguments:
            - '%kernel.root_dir%/../%env(string:STORAGE_CUSTOM)%'
        tags:
            - { name: test_taker.provider }
```

### Response formats

Response content type depends on requested data format.

To get `json`, call `[GET] http://api.tasty.localhost/test-takers.json`.
To get `xml`, call `[GET] http://api.tasty.localhost/test-takers.xml`.

Supported formats: `[json, xml, csv]`

To add custom one:

1. Extend standard symfony serializer to support your custom format.
2. Append this format to route requirements in `_format` section:

```yaml
 test_takers.list:
    path: /test-takers.{_format}
    controller: \Tasty\Controller\TestTakersController:list
    defaults:
        _format: json
    requirements:
        _format:  xml|csv|json
```
