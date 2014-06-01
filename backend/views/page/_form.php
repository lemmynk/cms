<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;


/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => 50]) ?>
    <?= $form->field($model, 'tpl_id')->dropDownList(backend\models\Template::getTemplateOptions()) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'status')->checkbox([], false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>