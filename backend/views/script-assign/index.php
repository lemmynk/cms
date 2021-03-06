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
$this->title = Yii::t('app', $breedTitle . ' Scripts And Styles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $breedTitle.'s' ), 'url' => [$breedUrl.'/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $pageTemplate->name), 'url' => [$breedUrl.'/view', 'id'=>$pageId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="script-assign-index">

    <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Add {modelClass}', ['modelClass' => 'Script Or Style',]), ['create', 'type'=>$assignType, 'pid'=>$pageId], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back To '.$breedTitle), [$breedUrl.'/view', 'id'=>$pageId], ['class' => 'btn btn-default']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'script_type',
                'value'=>function($data){
                    return $data->getScriptTypeText();
                }
            ],
            [
                'attribute'=>'script_id',
                'value'=>function($data){
                    return $data->getScriptName();
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->getStatusText($data->status);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
