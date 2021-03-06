<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\File $model
 */

$category = \backend\models\FileCategory::findOne($cid);
$this->title = Yii::t('app', $category->name.' - Add {modelClass}', [
  'modelClass' => 'Files',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'File Categories'), 'url' => ['file-category/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $category->name), 'url' => ['file-category/view', 'id'=>$cid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Add {modelClass}', ['modelClass' => 'Files',]);
?>
<div class="file-create">
        <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

        <?= Html::a(Yii::t('app', 'Back To Category'), ['file-category/view', 'id' => $cid], ['class' => 'btn btn-primary']) ?>

        <?= $this->render('_form', [
            'model' => $model,
            'cid'=>'cid'
        ]) ?>
    <?php /*</div>
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
    </div>/**/ ?>
</div>
