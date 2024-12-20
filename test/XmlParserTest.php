<?php

/**
 * Created by mcfedr on 1/15/16 12:14
 */
class XmlParserTest extends \PHPUnit\Framework\TestCase
{
    public function testXmlObject()
    {
        $mock = $this->getMockBuilder('Abaydullah\ApkParser\XmlParser')
            ->disableOriginalConstructor()
            ->onlyMethods(array('getXmlString'))
            ->getMock();

        $file = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'invalid.xml';
        $mock->expects($this->once())->method('getXmlString')->will($this->returnValue(file_get_contents($file)));

        $this->expectException(\Abaydullah\ApkParser\Exceptions\XmlParserException::class);

        $mock->getXmlObject();
    }
}
