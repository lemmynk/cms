<?php
/**
 * Created by miller 
 * Date: 5/13/14
 * Time: 3:53 PM
 */
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CkEditorAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets/ckeditor';
    //public $baseUrl = '@web';
    public $css = [];
    public $js = ['ckeditor.js'];
    /*public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];/**/
}