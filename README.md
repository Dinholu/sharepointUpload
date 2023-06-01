# Very short description of the package

Package for uploading files to sharepoint

## Installation

Git clone the package

Add to your composer.json files

```bash
require "sharepointupload/sharepoint-upload": "dev-main"
repositories [{
            "type": "path",
            "url": "../SharepointUpload"
        }]
```

## Usage

You can use the package this way

```bash
    $uploader = new SharepointUpload();

    $file_path = "test.txt";
    $library_name = ENV('LIBRARY_NAME');
    $site_url = ENV('SITE_URL');
    $client_id = ENV('CLIENT_ID');
    $tenant_id = ENV('TENANT_ID');
    $client_secret = ENV('CLIENT_SECRET');
    $resource = ENV('RESOURCE');

    return $uploader->uploadFile($file_path, $library_name, $site_url, $client_id, $tenant_id, $client_secret, $resource);
```

### Security

If you discover any security related issues, please email alizee.hett@t-med.fr instead of using the issue tracker.

## Credits

- [Alizée HETT](https://github.com/sharepointupload)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
