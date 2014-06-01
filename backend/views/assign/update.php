<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\Assign $model
 */
$pageTemplate = $assignType == 'P' ? backend\models\Page::findOne(['id'=>$pageId]) : backend\models\Template::findOne(['id'=>$pageId]);
$breedTitle = $assignType == 'P' ? 'Page' : 'Template';
$breedUrl = $assignType == 'P' ? 'page' : 'template';
$this->title = Yii::t('app', 'Update '.$breedTitle. ' Assign');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $breedTitle.'s' ), 'url' => [$breedUrl.'/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $pageTemplate->name), 'url' => [$breedUrl.'/view', 'id'=>$pageId]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assigns'), 'url' => ['index', 'type'=>$assignType, 'pid'=>$pageId]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="assign-update">
    <div class="col-md-9">
        <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

        <?= $this->render('_form', [
            'model' => $model,
            'pageId'=>$model->page_id,
            'assignType'=>$model->assign_type
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
