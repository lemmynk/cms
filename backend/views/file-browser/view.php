<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\bootstrap\Modal;

/**
 * @var yii\web\View $this
 * @var backend\models\FileCategory $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'File Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-category-view">
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Yii::t('app', 'Add Files'), ['file/create', 'cid'=>$model->id], [
                'class' => 'btn btn-success',
            ]) ?>
            <?php //echo Html::a(Yii::t('app', 'Back to list'), ['index'], ['class' => 'btn btn-default']) ?>
        </p>

        <?php /*echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                  'id',
              'name',
              'filename',
               [
                    'attribute'=>'status',
                    'value'=>$model->getStatusText($model->status)
                ],
            ],
        ]) /**/?>
        <div class="files">
            <!--<h2 class="page-header">Files</h2>-->
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'summary'=>'',
                'itemView' => function ($data, $key, $index, $widget) {
                        return Html::a(Html::img($data->getFileUrl(), [
                            'alt'=>$data->name,
                            'title'=>$data->name,
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'top',
                            'class'=>'thumbnail',
                            'width'=>200,
                            'height'=>100,
                            'style'=>'float: left; margin-right: 10px; cursor: pointer']
                        ), '#');
                    }
                ]);
            ?>
        </div>
</div>

<?php
$js = <<<JS
var links = $(".files").find("a"),
getUrlParam = function( paramName ){
    var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' ) ;
    var match = window.location.search.match(reParam) ;

    return ( match && match.length > 1 ) ? match[ 1 ] : null ;
};
$.each(links, function(i, v){
    var link = $(v);
    link.on("click", function(e){
        e.preventDefault();
        var funcNum = getUrlParam( 'CKEditorFuncNum' ),
            img = link.find("img");
        console.log(img.attr("src"));
        window.opener.CKEDITOR.tools.callFunction( funcNum, img.attr("src"));
        window.close();
        //return false;
    });
});
JS;
?>
<?php $this->registerJs($js); ?>