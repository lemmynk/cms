<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\Content $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Content',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-create">
    <div class="col-md-9">
        <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    <div class="col-md-3">
        <h2 class="page-header">System info</h2>
        <div style="margin: 63px 0"></div>
        <?= DetailView::widget([
            'model' => $model,
            'attributes'=>[
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
                ],
            ]
        ]) ?>
    </div>
</div>
