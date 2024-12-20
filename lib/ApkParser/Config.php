<?php
/**
 * This file is part of the Apk Parser package.
 *
 * (c) Mim Abaydullah <abaydullah786@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Abaydullah\ApkParser;

/**
 * Class Config
 * @package ApkParser
 * @property $tmp_path string
 * @property $jar_path string
 * @property $manifest_only boolean
 */
class Config
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge(
            [
                'tmp_path' => sys_get_temp_dir(),
                'jar_path' => __DIR__ . '/Dex/dedexer.jar',
                'manifest_only' => true
            ],
            $config
        );
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->config[$key];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->config[$key];
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     * @internal param $key
     */
    public function __set($name, $value)
    {
        return $this->config[$name] = $value;
    }
}
