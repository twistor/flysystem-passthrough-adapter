<?php

namespace Twistor\Flysystem;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;

/**
 * An adapter that wraps another adapter.
 */
class PassthroughAdapter implements AdapterInterface
{
    /**
     * The wrapped adapter.
     *
     * @var \League\Flysystem\AdapterInterface
     */
    private $adapter;

    /**
     * Constructs a PassthroughAdapter object.
     *
     * @param \League\Flysystem\AdapterInterface $adapter The adapter to wrap.
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Returns the wrapped adapter.
     *
     * Subclasses should use this to access the adapter when overriding methods.
     *
     * @return League\Flysystem\AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @inheritdoc
     */
    public function copy($path, $newpath)
    {
        return $this->adapter->copy($path, $newpath);
    }

    /**
     * @inheritdoc
     */
    public function createDir($path, Config $config)
    {
        return $this->adapter->createDir($path, $config);
    }

    /**
     * @inheritdoc
     */
    public function delete($path)
    {
        return $this->adapter->delete($path);
    }

    /**
     * @inheritdoc
     */
    public function deleteDir($path)
    {
        return $this->adapter->deleteDir($path);
    }

    /**
     * @inheritdoc
     */
    public function getMetadata($path)
    {
        return $this->adapter->getMetadata($path);
    }

    /**
     * @inheritdoc
     */
    public function getMimetype($path)
    {
        return $this->adapter->getMimetype($path);
    }

    /**
     * @inheritdoc
     */
    public function getSize($path)
    {
        return $this->adapter->getSize($path);
    }

    /**
     * @inheritdoc
     */
    public function getTimestamp($path)
    {
        return $this->adapter->getTimestamp($path);
    }

    /**
     * @inheritdoc
     */
    public function getVisibility($path)
    {
        return $this->adapter->getVisibility($path);
    }

    /**
     * @inheritdoc
     */
    public function has($path)
    {
        return $this->adapter->has($path);
    }

    /**
     * @inheritdoc
     */
    public function listContents($directory = '', $recursive = false)
    {
        return $this->adapter->listContents($directory, $recursive);
    }

    /**
     * @inheritdoc
     */
    public function read($path)
    {
        return $this->adapter->read($path);
    }

    /**
     * @inheritdoc
     */
    public function readStream($path)
    {
        return $this->adapter->readStream($path);
    }

    /**
     * @inheritdoc
     */
    public function rename($path, $newpath)
    {
        return $this->adapter->rename($path, $newpath);
    }

    /**
     * @inheritdoc
     */
    public function setVisibility($path, $visibility)
    {
        return $this->adapter->setVisibility($path, $visibility);
    }

    /**
     * @inheritdoc
     */
    public function update($path, $contents, Config $config)
    {
        return $this->adapter->update($path, $contents, $config);
    }

    /**
     * @inheritdoc
     */
    public function updateStream($path, $resource, Config $config)
    {
        return $this->adapter->updateStream($path, $resource, $config);
    }

    /**
     * @inheritdoc
     */
    public function write($path, $contents, Config $config)
    {
        return $this->adapter->write($path, $contents, $config);
    }

    /**
     * @inheritdoc
     */
    public function writeStream($path, $resource, Config $config)
    {
        return $this->adapter->writeStream($path, $resource, $config);
    }
}
