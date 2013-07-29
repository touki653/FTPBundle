# PHP FTP Wrapper Bundle

This is a Symfony2 bundle to wrap the [FTP Component](https://github.com/touki653/php-ftp-wrapper)

# Installation

**composer.json**

```json
{
    "require": {
        "touki/ftp-bundle": "dev-master"
    }
}
```

Then run

```sh
$ composer install touki/ftp-bundle
```

Then you must add the bundle in your `AppKernel.php`

```php
<?php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            // ...
            new Touki\Bundle\FTPBundle\ToukiFTPBundle()
        );
    }
}

?>
```

# Configuration

The default configuration is as follows

```yml
touki_ftp:
    host:     localhost # Remote server name
    username: anonymous # Username to connect with
    password: guest     # Password to connect with
    port:     21        # Port to connect to
    secured:  false     # Whether to connect with SSL or not
```

# Service list

For the standard usage of the component, please read the [documentation](https://github.com/touki653/php-ftp-wrapper/tree/master/docs)

```php
<?php
$container->get('ftp.connection');
?>
```

Holds the connection to the server.
It opens it by default.

```
<?php
$container->get('ftp.wrapper');
?>
```

The simple FTP wrapper.

```
<?php
$container->get('ftp.manager');
?>
```

The filesystem manager

```
<?php
$container->get('ftp');
?>
```

The main FTP Class

# Adding a downloader

To add a custom downloader, you need to create a downloader which implements the interfaces as follows

```php
<?php

namespace Acme\FooBundle\Downloader;

use Touki\FTP\DownloaderInterface;
use Touki\FTP\DownloaderVotableInterface;
use Touki\FTP\Model\Filesystem;

class MyDownloader implements DownloaderInterface, DownloaderVotableInterface
{
    /**
     * {@inheritDoc}
     */
    public function vote($local, Filesystem $remote, array $options = array())
    {
        // Return a boolean based on arguments given to check if the downloader is compatible
    }

    /**
     * {@inheritDoc}
     */
    public function download($local, Filesystem $remote, array $options = array())
    {
        // Process the download
    }
}
?>
```

Then in your `services.yml`, create a new service which adds the `ftp.downloader` tag

```yml
services:
    acme_foo.mydownloader:
        class: Acme\FooBundle\Downloader\MyDownloader
        tags:
            - { name: ftp.downloader, prepend: false } # Set prepend to true to prepend the downloader
```

# Adding an uploader

To add a custom uploader, you need to create a uploader which implements the interfaces as follows

```php
<?php

namespace Acme\FooBundle\Uploader;

use Touki\FTP\UploaderInterface;
use Touki\FTP\UploaderVotableInterface;
use Touki\FTP\Model\Filesystem;

class MyUploader implements UploaderInterface, UploaderVotableInterface
{
    /**
     * {@inheritDoc}
     */
    public function vote(Filesystem $remote, $local, array $options = array())
    {
        // Return a boolean based on arguments given to check if the uploader is compatible
    }

    /**
     * {@inheritDoc}
     */
    public function upload(Filesystem $remote, $local, array $options = array())
    {
        // Process the upload
    }
}
?>
```

Then in your `services.yml`, create a new service which adds the `ftp.uploader` tag

```yml
services:
    acme_foo.myuploader:
        class: Acme\FooBundle\Uploader\MyUploader
        tags:
            - { name: ftp.uploader, prepend: false } # Set prepend to true to prepend the uploader
```
