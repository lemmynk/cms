<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'File Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-category-index">

    <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'File Category',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options'=>['class'=>'row'],
        'itemOptions' => ['class' => 'col-xs-6 col-md-3',],
        'summary'=>'',
        'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::img(Yii::$app->request->getBaseUrl().'/images/folder-ico-black.png').'<div class="caption"><p>'.Html::encode($model->name).'</p></div>', ['view', 'id' => $model->id], ['class' => 'thumbnail']);
        },
    ]) ?>

</div>
