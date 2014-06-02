<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\ScriptAssign $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="script-assign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page_id')->hiddenInput(['value'=>$pageId])->label(false) ?>
    <?= $form->field($model, 'assign_type')->hiddenInput(['value'=>$assignType])->label(false) ?>
    <?= $form->field($model, 'script_type')->dropDownList($model->getScriptTypeOptions(), ['prompt'=>'Select Script Type']) ?>
    <?= $form->field($model, 'script_id')->dropDownList([], ['prompt'=>'']) ?>
    <?= $form->field($model, 'status')->checkbox([], false) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS
$("#scriptassign-script_type").on("change", function(){
//console.log($(this).val());
    $.ajax({
        type : 'POST',
        data : {'stype': $(this).val()},
        dataType : 'JSON',
        success : function(data){
            $("#scriptassign-script_id").html(data);
        }
    });
})
JS;

$this->registerJs($script, $this::POS_END, 'script-assign')
?>
