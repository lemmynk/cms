<?php
/**
 * Created by miller
 * Date: 6/10/14
 * Time: 7:04 PM
 */

namespace miller\fileuploader;

use yii\web\AssetBundle;

class FileUploaderAssets extends AssetBundle
{
    public $sourcePath = '@ext/yii2-fileuploader/assets';

    public $js = ['js/jquery.uploader.js'];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 