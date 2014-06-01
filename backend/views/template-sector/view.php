<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\TemplateSector $model
 */
$template = $model->getTemplate()->one();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Templates'), 'url' => ['template/index']];
$this->params['breadcrumbs'][] = ['label' => $template->name, 'url' => ['template/view', 'id'=>$template->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sectors'), 'url' => ['index', 'id'=>$model->tpl_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-sector-view">
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
            <?= Html::a(Yii::t('app', 'Back to list'), ['index', 'id'=>$model->tpl_id], ['class' => 'btn btn-default']) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
              'name',
              'filename',
              [
                  'attribute'=>'tpl_id',
                  'value'=>$model->getTemplateName()
              ],
                [
                    'attribute'=>'sector_type',
                    'value'=>$model->getSectorTypeName()
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
