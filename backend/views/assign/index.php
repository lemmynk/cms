<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$pageTemplate = $assignType == 'P' ? backend\models\Page::findOne(['id'=>$pageId]) : backend\models\Template::findOne(['id'=>$pageId]);
$breedTitle = $assignType == 'P' ? 'Page' : 'Template';
$breedUrl = $assignType == 'P' ? 'page' : 'template';
$this->title = Yii::t('app', $breedTitle . ' Assigns');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $breedTitle.'s' ), 'url' => [$breedUrl.'/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $pageTemplate->name), 'url' => [$breedUrl.'/view', 'id'=>$pageId]];
$this->params['breadcrumbs'][] = $this->title;
//backend\helpers\HelpFunctions::echoArray($this->params['breadcrumbs']);
?>
<div class="assign-index">

    <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Add {modelClass}', ['modelClass' => 'Assign',]), ['create', 'type'=>$assignType, 'pid'=>$pageId], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back To '.$breedTitle), [$breedUrl.'/view', 'id'=>$pageId], ['class' => 'btn btn-default']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'lang_id',
            //'assign_type',
            //'page_id',
            [
                'attribute'=>'sector_id',
                'value'=>function($data){
                    return $data->getSector()->one()->name;
                }
            ],
            [
                'attribute'=>'content_type',
                'value'=>function($data){
                    return $data->getContentTypeName();
                }
            ],
            [
                'attribute'=>'content_id',
                'value'=>function($data){
                    return $data->getContentName();
                }
            ],
            'order_by',
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
