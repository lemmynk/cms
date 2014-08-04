<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use backend\models\FileCategory;
use yii\data\ActiveDataProvider;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$dataProvider = new ActiveDataProvider([
    'query' => FileCategory::find(),
    'pagination'=>false
]);
?>
<?php $this->beginContent('@backend/views/layouts/column.php'); ?>

    <div class="file-category-index">

        <h2 class="page-header" id="page-title"><?= Html::encode($this->title) ?></h2>
        <div class="col-xs-4 col-md-2" style="background-color: #f5f5f5; padding-top: 10px">
            <p>
                <?= Html::a(Yii::t('app', 'New'), ['create'], [
                    'class' => 'btn btn-success',
                    'style'=>'width: 100%'
                ]) ?>
            </p>

            <?php /*echo ListView::widget([
                'dataProvider' => $dataProvider,
                'options'=>['class'=>'row'],
                'itemOptions' => ['class' => 'col-xs-6 col-md-3',],
                'summary'=>'',
                'itemView' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::img(Yii::$app->request->getBaseUrl().'/images/folder-ico-black.png').'<div class="caption"><p>'.Html::encode($model->name).'</p></div>', ['view', 'id' => $model->id], ['class' => 'thumbnail']);
                    },
            ]) /**/?>
            <ul class="list-unstyled category-list">
                <?php foreach($dataProvider->models as $model): ?>
                    <li class="file-cat">
                        <?php echo Html::a('<i class="glyphicon glyphicon-folder-close"></i>' . Html::encode($model->name), ['view', 'id'=>$model->id], ['class'=>'view-files', 'id'=>$model->name]) ?>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="col-xs-14 col-md-10" id="files-list">
            <?= $content ?>
        </div>
    </div>
<?php
$js = <<<JS
var links = $(".category-list").find("a");
$.each(links, function(i, link){
       var lnk = $(link);
       if(lnk.attr("href") === window.location.pathname + window.location.search){
            lnk.addClass("active");
            lnk.find("i").removeClass("glyphicon glyphicon-folder-close").addClass("glyphicon glyphicon-folder-open");

       }else{
            lnk.removeClass("active");
            lnk.find("i").removeClass("glyphicon glyphicon-folder-open").addClass("glyphicon glyphicon-folder-close");
       }
   });
JS;
$this->registerJs($js);
?>
<?php $this->endContent(); ?>