<?php

use Abaydullah\ApkParser\Manifest;

/**
 * Created by mcfedr on 1/15/16 12:43
 */
class ManifestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Abaydullah\ApkParser\Exceptions\XmlParserException
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \PHPUnit\Framework\MockObject\RuntimeException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testMetaData()
    {
        $mock = $this->getMockBuilder('Abaydullah\ApkParser\XmlParser')
            ->disableOriginalConstructor()
            ->onlyMethods(array('getXmlString'))
            ->getMock();

        $file = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'meta.xml';
        $mock->expects($this->once())->method('getXmlString')->will($this->returnValue(file_get_contents($file)));

        $manifest = new Manifest($mock);

        $this->assertEquals('0x7f0c0012', $manifest->getMetaData('com.google.android.gms.version'));
    }
}
