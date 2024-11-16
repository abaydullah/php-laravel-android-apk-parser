<?php

/**
 * This file is part of the Apk Parser package.
 *
 * (c) Mim Abaydullah <abaydullah786@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Abaydullah\ApkParser\Parser;

include 'autoload.php';
$apk = new Parser('vitrinova.apk', ['manifest_only' => false]);
$resourceId = $apk->getManifest()->getApplication()->getIcon();
$resources = $apk->getResources($resourceId);

$labelResourceId = $apk->getManifest()->getApplication()->getLabel();
$appLabel = $apk->getResources($labelResourceId);
echo $appLabel[0];

header('Content-type: text/html');
echo $appLabel[0] . '<br/>';
foreach ($resources as $resource) {
    echo '<img src="data:image/png;base64,', base64_encode(stream_get_contents($apk->getStream($resource))), '" />';
}
