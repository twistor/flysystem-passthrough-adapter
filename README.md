# Flysystem passthrough adapter

[![Author](http://img.shields.io/badge/author-@chrisleppanen-blue.svg?style=flat-square)](https://twitter.com/chrisleppanen)
[![Build Status](https://img.shields.io/travis/twistor/flysystem-passthrough-adapter/master.svg?style=flat-square)](https://travis-ci.org/twistor/flysystem-passthrough-adapter)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/twistor/flysystem-passthrough-adapter.svg?style=flat-square)](https://scrutinizer-ci.com/g/twistor/flysystem-passthrough-adapter/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/twistor/flysystem-passthrough-adapter.svg?style=flat-square)](https://scrutinizer-ci.com/g/twistor/flysystem-passthrough-adapter/)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/twistor/flysystem-passthrough-adapter.svg?style=flat-square)](https://packagist.org/packages/twistor/flysystem-passthrough-adapter)

## Installation

```bash
composer require twistor/flysystem-passthrough-adapter
```

## Usage

This package doesn't do anything on its own. It simply provides a base class
that simplifies the creation of adapters that wrap other adapters.

To use it, subclass \Twistor\Flysystem\PassthroughAdapter and override any
methods.

```php
<?php

use League\Flysystem\AdapterInterface;
use Twistor\Flysystem\PassthroughAdapter;

class UppercaseAdapter extends PassthroughAdapter
{
    /**
     * Constructs an UppercaseAdapter.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct($adapter);
    }

    /**
     * @inheritdoc
     */
    public function read($path)
    {
        $result = $this->getAdapter()->read($path);

        if ($result === false) {
            return false;
        }

        $result['contents'] = strtoupper($result['contents']);

        return $result;
    }
}
