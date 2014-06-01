<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\TemplateSector $model
 */

$template = backend\models\Template::findOne(['id'=>$tplId]);
$title = 'Add Sector';
$this->title = Yii::t('app', '{title}', ['title'=>$title]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Templates'), 'url' => ['template/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '{template}', ['template'=>$template->name]), 'url' => ['template/view', 'id'=>$tplId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-sector-create">
    <div class="col-md-9">
        <h2 class="page-header"><?= Html::encode($template->name . ' Template - '.  $this->title) ?></h2>

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
