<?php

use Gregwar\Cache\Cache;

/**
 * Unit testing for Cache
 */
class CacheTests extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing that file names are good
     */
    public function testFileName()
    {
        $cache = $this->getCache();

        $cacheDir = $this->getCacheDirectory();
        $actualCacheDir = $this->getActualCacheDirectory();
        $cacheFile = $cache->getCacheFile('helloworld.txt');
        $actualCacheFile = $cache->getCacheFile('helloworld.txt', true);
        $this->assertEquals($cacheDir . '/h/e/l/l/o/helloworld.txt', $cacheFile);
        $this->assertEquals($actualCacheDir . '/h/e/l/l/o/helloworld.txt', $actualCacheFile);

        $cacheFile = $cache->getCacheFile('xy.txt');
        $actualCacheFile = $cache->getCacheFile('xy.txt', true);
        $this->assertEquals($cacheDir . '/x/y/xy.txt', $cacheFile);
        $this->assertEquals($actualCacheDir . '/x/y/xy.txt', $actualCacheFile);
    }

    /**
     * Testing caching a file
     */
    public function testCaching()
    {
        $cache = $this->getCache();

        $this->assertFalse($cache->exists('testing.txt'));
        $cache->set('testing.txt', 'toto');
        $this->assertTrue($cache->exists('testing.txt'));
        
        $this->assertFalse($cache->exists('testing2.txt'));
        $cache->write('testing2.txt', 'toto');
        $this->assertTrue($cache->exists('testing2.txt'));

        $this->assertFalse($cache->exists('testing.txt', array(
            'max-age' => -1
        )));
        $this->assertTrue($cache->exists('testing.txt', array(
            'max-age' => 2
        )));
    }

    /**
     * Testing the getOrCreate function
     */
    public function testGetOrCreate()
    {
        $cache = $this->getCache();

        $this->assertFalse($cache->exists('testing.txt'));

        $data = $cache->getOrCreate('testing.txt', array(), function() {
            return 'zebra';
        });

        $this->assertTrue($cache->exists('testing.txt'));
        $this->assertEquals('zebra', $data);

        $data = $cache->getOrCreate('testing.txt', array(), function() {
            return 'elephant';
        });
        $this->assertEquals('zebra', $data);
    }

    /**
     * Testing the getOrCreate function with $file=true
     */
    public function testGetOrCreateFile()
    {
        $dir = __DIR__;
        $cache = $this->getCache();

        $file = $dir.'/'.$cache->getOrCreateFile('file.txt', array(), function() {
            return 'xyz';
        });
        $file2 = $dir.'/'.$cache->getOrCreate('file.txt', array(), function(){}, true);

        $this->assertEquals($file, $file2);
        $this->assertTrue(file_exists($file));
        $this->assertEquals('xyz', file_get_contents($file));
    }

    /**
     * Testing that the not existing younger file works
     */
    public function testNotExistingYounger()
    {
        $cache = $this->getCache();

        $data = $cache->getOrCreate('testing.txt', array('younger-than'=> 'i-dont-exist'), function() {
            return 'some-data';
        });

        $this->assertEquals('some-data', $data);
    }

    protected function getCache()
    {
        $cache = new Cache;

        return $cache
            ->setPrefixSize(5)
            ->setCacheDirectory($this->getCacheDirectory())
            ->setActualCacheDirectory($this->getActualCacheDirectory())
            ;
    }

    protected function getActualCacheDirectory()
    {
        return __DIR__.'/'.$this->getCacheDirectory();
    }

    protected function getCacheDirectory()
    {
        return 'cache';
    }

    public function tearDown()
    {
        $cacheDirectory = $this->getActualCacheDirectory();
        `rm -rf $cacheDirectory`;
    }
}
