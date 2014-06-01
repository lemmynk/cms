<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\TemplateSector $model
 * @var yii\widgets\ActiveForm $form
 */
$template = backend\models\Template::findOne(['id'=>$tplId]);
$this->registerJs("$('#toggle-tpl-form').click(function(e){
        e.preventDefault();
        $('#tpl-form-view').toggle();
        return false;
})", $this::POS_END, 'tpl-form-view');/**/
?>

<div class="template-sector-form">

    <p>
        <?= Html::a(Yii::t('app', 'View Template Form'), ['#'], ['class' => 'btn btn-primary', 'id'=>'toggle-tpl-form']) ?>
    </p>

    <?= Html::textarea('', $template->template_form, ['id'=>'tpl-form-view', 'style'=>'display: none',  'rows'=>6, 'class'=>'form-control', 'disabled'=>'disabled']) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tpl_id')->hiddenInput(['value'=>$tplId])->label(false) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'filename')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'sector_type')->dropDownList($model->getSectorTypeOptions()) ?>
    <?= $form->field($model, 'status')->checkbox([], false) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['index', 'id'=>$tplId] : ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
