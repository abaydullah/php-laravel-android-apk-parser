<?php
/**
 * This file is part of the Apk Parser package.
 *
 * (c) Mim Abaydullah <abaydullah786@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

include 'autoload.php';

$apk = new Abaydullah\ApkParser\Parser('EBHS.apk');

echo '<pre>';
foreach ($apk->getClasses() as $className) {
    echo $className . PHP_EOL;
}
