<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$template = backend\models\Template::findOne(['id'=>$tplId]);
$title = $template->name . ' Template - Sectors';
$this->title = Yii::t('app', '{title}', ['title'=>$title]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Templates'), 'url' => ['template/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '{template}', ['template'=>$template->name]), 'url' => ['template/view', 'id'=>$tplId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Sectors');;
?>
<div class="template-sector-index">

    <h2 class="page-header"><?= Html::encode($title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', ['modelClass' => 'Sector',]), ['create', 'id'=>$tplId], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back To Template'), ['template/view', 'id'=>$tplId], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'filename',
            [
                'attribute'=>'sector_type',
                'value'=>function($data){
                return $data->getSectorTypeName();
            }
            ],
            //'tpl_id',
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
