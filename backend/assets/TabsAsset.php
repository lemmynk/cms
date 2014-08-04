<?php
/**
 * Created by miller
 * Date: 7/10/14
 * Time: 12:52 PM
 */

namespace backend\assets;

use yii\web\AssetBundle;

class TabsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = ['js/tabs.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 