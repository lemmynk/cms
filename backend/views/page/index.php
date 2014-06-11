<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Page',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute'=>'url',
                'format'=>'raw',
                'value'=>function($data){
                        return $data->getPageFrontendUrl();
                }
            ],
            [
                'attribute'=>'tpl_id',
                'value'=>function($data){
                    return $data->getTemplate()->name;
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->getStatusText($data->status);
                }
            ],
            // 'keywords:ntext',
            // 'description:ntext',
            // 'status',
            // 'deleted',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
