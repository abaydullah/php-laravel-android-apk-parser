<?php

namespace Abaydullah\ApkParser;

use Abaydullah\ApkParser\Activity;
use Abaydullah\ApkParser\ManifestXmlElement;

/**
 * This file is part of the Apk Parser package.
 *
 * (c) Mim Abaydullah <abaydullah786@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Application
{
    /**
     * @var \Abaydullah\ApkParser\Activity[]
     */
    public $activities = array();

    /**
     * @var ManifestXmlElement
     */
    private $application;

    public function __construct(ManifestXmlElement $application)
    {
        $this->application = $application;

        foreach ($application->activity as $actXml) {
            $this->activities[] = new Activity($actXml);
        }
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->getAttr('icon');
    }

    /**
     * @param $attrName
     * @return string
     */
    public function getAttr($attrName)
    {
        $attr = get_object_vars($this->application);
        return isset($attr['@attributes']) && isset($attr['@attributes'][$attrName]) ? (string)$attr['@attributes'][$attrName] : null;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->getAttr('label');
    }

    /**
     * @return string
     */
    public function getActivityHash()
    {
        return md5(implode('', $this->getActivityNameList()));
    }

    /**
     * @return array
     */
    public function getActivityNameList()
    {
        $names = array();

        foreach ($this->activities as $act) {
            $names[] = trim($act->getName(), '.');
        }

        return $names;
    }
}
