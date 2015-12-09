<?php

use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;
use League\Flysystem\Memory\MemoryAdapter;
use Twistor\Flysystem\PassthroughAdapter;

/**
 * @coversDefaultClass \Twistor\Flysystem\PassthroughAdapter
 */
class PassthroughAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The adapter wrapper.
     *
     * @var \Twistor\Flysystem\PassthroughAdapter
     */
    protected $adapter;

    /**
     * The memory adapter.
     *
     * @var \League\Flysystem\Memory\MemoryAdapter
     */
    protected $memory;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->memory = new MemoryAdapter();
        $this->memory->write('file.txt', 'file content', new Config());
        $this->adapter = new PassthroughAdapter($this->memory);
    }

    /**
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf('League\Flysystem\AdapterInterface', new PassthroughAdapter(new MemoryAdapter()));
    }

    /**
     * @covers ::getAdapter
     */
    public function testGetAdapter()
    {
        $this->assertSame($this->adapter->getAdapter(), $this->memory);
    }

    /**
     * @covers ::copy
     */
    public function testCopy()
    {
        $this->assertTrue($this->adapter->copy('file.txt', 'other.txt'));
    }

    /**
     * @covers ::createDir
     */
    public function testCreateDir()
    {
        $this->assertInternalType('array', $this->adapter->createDir('dir', new Config()));
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $this->assertTrue($this->adapter->delete('file.txt'));
    }

    /**
     * @covers ::deleteDir
     */
    public function testDeleteDir()
    {
        $this->assertFalse($this->adapter->deleteDir('dir'));
    }

    /**
     * @covers ::getMetaData
     */
    public function testGetMetadata()
    {
        $this->assertInternalType('array', $this->adapter->getMetadata('file.txt'));
    }

    /**
     * @covers ::getMimetype
     */
    public function testGetMimetype()
    {
        $this->assertInternalType('array', $this->adapter->getMimetype('file.txt'));
    }

    /**
     * @covers ::getSize
     */
    public function testGetSize()
    {
        $this->assertInternalType('array', $this->adapter->getSize('file.txt'));
    }

    /**
     * @covers ::getTimestamp
     */
    public function testGetTimestamp()
    {
        $this->assertInternalType('array', $this->adapter->getTimestamp('file.txt'));
    }

    /**
     * @covers ::getVisibility
     */
    public function testGetVisibility()
    {
        $this->assertInternalType('array', $this->adapter->getVisibility('file.txt'));
    }

    /**
     * @covers ::has
     */
    public function testHas()
    {
        $this->assertTrue($this->adapter->has('file.txt'));
    }

    /**
     * @covers ::listContents
     */
    public function testListContents()
    {
        $this->assertSame([], $this->adapter->listContents('dir'));
    }

    /**
     * @covers ::read
     */
    public function testRead()
    {
        $this->assertInternalType('array', $this->adapter->read('file.txt', new Config()));
    }

    /**
     * @covers ::readStream
     */
    public function testReadStream()
    {
        $result = $this->adapter->readStream('file.txt', new Config());
        $this->assertInternalType('array', $result);
        fclose($result['stream']);
    }

    /**
     * @covers ::rename
     */
    public function testRename()
    {
        $this->assertTrue($this->adapter->rename('file.txt', 'new_file.txt'));
    }

    /**
     * @covers ::setVisibility
     */
    public function testSetVisibility()
    {
        $this->assertInternalType('array', $this->adapter->setVisibility('file.txt', AdapterInterface::VISIBILITY_PUBLIC));
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $this->assertInternalType('array', $this->adapter->update('file.txt', 'contents', new Config()));
    }

    /**
     * @covers ::updateStream
     */
    public function testUpdateStream()
    {
        $stream = fopen('data:text/plain,filecontent', 'r+b');
        $this->assertInternalType('array', $this->adapter->updateStream('file.txt', $stream, new Config()));
        fclose($stream);
    }


    /**
     * @covers ::write
     */
    public function testWrite()
    {
        $this->assertInternalType('array', $this->adapter->write('file.txt', 'file content', new Config()));
    }

    /**
     * @covers ::writeStream
     */
    public function testWriteStream()
    {
        $stream = fopen('data:text/plain,filecontent', 'r+b');
        $this->assertInternalType('array', $this->adapter->writeStream('file.txt', $stream, new Config()));
        fclose($stream);
    }
}
