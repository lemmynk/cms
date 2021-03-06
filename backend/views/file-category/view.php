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
<div class="file-category-view" id="file-category-view">
    <!--<div class="col-md-9">-->
        <!--<h2 class="page-header"><?php //echo Html::encode($this->title) ?></h2>-->
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
                            'width'=>100,
                            'height'=>100,
                            'style'=>'float: left; margin-right: 10px']),
                            ['file/view', 'id'=>$data->id],
                            ['class'=>'file-view-ajax']
                        );
                    }
                ]);
            ?>
        </div>
    <!--</div>-->
    <!--<div class="col-md-3">
        <h2 class="page-header">System info</h2>
        <div style="margin: 63px 0"></div>
        <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
                [
                'attribute'=>'created_at',
                'value'=>!$model->isNewRecord ? date('d. m. Y', $model->created_at) : ''
                ],
                [
                'attribute'=>'created_by',
                'value'=>!$model->isNewRecord ? $model->getCreator()->one()->getUserName() : ''
                ],
                [
                'attribute'=>'updated_at',
                'value'=>!$model->isNewRecord ? date('d. m. Y', $model->updated_at) : ''
                ],
                [
                'attribute'=>'updated_by',
                'value'=>!$model->isNewRecord ? $model->getCreator()->one()->getUserName() : ''
                ]
            ],
        ]) /**/?>
    </div>-->
</div>
<?php
$js = <<<JS
var fileLinks = $(".files").find("a");
$.each(fileLinks, function(i, v){
    $(v).on("click", function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(v).attr("href"),
            //dataType: 'json',
            success: function(data){
                $("#file-category-view").html(data);
            }
        });
    });
});
JS;

?>
<?php $this->registerJs('$(".thumbnail").tooltip();');
$this->registerJs($js);
?>