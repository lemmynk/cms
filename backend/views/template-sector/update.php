<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\TemplateSector $model
 */

$template = $model->getTemplate()->one();
$this->title = Yii::t('app', 'Update {modelClass} - ', [
  'modelClass' => 'Sector',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Templates'), 'url' => ['template/index']];
$this->params['breadcrumbs'][] = ['label' => $template->name, 'url' => ['template/view', 'id'=>$template->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sectors'), 'url' => ['index', 'id'=>$model->tpl_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="template-sector-update">
    <div class="col-md-9">
        <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

        <?= $this->render('_form', [
            'model' => $model,
            'tplId'=>$tplId
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
