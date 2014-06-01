<?php
/**
 * Created by miller 
 * Date: 5/20/14
 * Time: 4:31 PM
 */

namespace backend\assets;

use yii\web\AssetBundle;

class ChosenDropdownAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets/chosen';
    public $css = ['chosen.css'];
    public $js = ['chosen.jquery.min.js'];
    public $depends = [
        'yii\web\YiiAsset',
    ];/**/
}