<?php
/**
 * Created by miller 
 * Date: 5/9/14
 * Time: 1:11 PM
 */
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AcEditorAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets/aceditor';
    public $sourceUrl = '@backend\assets\aceditor';
    //public $css = [];
    public $js = ['ace.js'];
    /*public $depends = [
        'js/aceditor',
    ];/**/
}