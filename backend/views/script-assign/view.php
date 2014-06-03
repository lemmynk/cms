<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\ScriptAssign $model
 */

$pageTemplate = $assignType == 'P' ? backend\models\Page::findOne(['id'=>$pageId]) : backend\models\Template::findOne(['id'=>$pageId]);
$breedTitle = $assignType == 'P' ? 'Page' : 'Template';
$breedUrl = $assignType == 'P' ? 'page' : 'template';
$this->title = Yii::t('app', 'View '.$breedTitle. ' Script '. $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $breedTitle.'s' ), 'url' => [$breedUrl.'/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $pageTemplate->name), 'url' => [$breedUrl.'/view', 'id'=>$pageId]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Scripts'), 'url' => ['index', 'type'=>$assignType, 'pid'=>$pageId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="script-assign-view">
    <div class="col-md-9">
        <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Yii::t('app', 'Back to list'), ['index', 'type'=>$model->assign_type, 'pid'=>$model->page_id], ['class' => 'btn btn-default']) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute'=>'script_type',
                    'value'=>$model->getScriptTypeText()
                ],
                [
                    'attribute'=>'script_id',
                    'value'=>$model->getScriptName()
                ],
                [
                    'attribute'=>'status',
                    'value'=>$model->getStatusText($model->status)
                ],
            ],
        ]) ?>
    </div>
    <div class="col-md-3">
        <h2 class="page-header">System info</h2>
        <div style="margin: 63px 0"></div>
        <?= DetailView::widget([
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
        ]) ?>
    </div>
</div>
