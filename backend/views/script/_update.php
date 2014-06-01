<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AcEditorAsset;

AcEditorAsset::register($this);

/**
 * @var yii\web\View $this
 * @var backend\models\Script $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="script-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'type')->dropDownList($model->getTypeOptions(), ['prompt'=>'Select Type', 'disabled'=>'disabled']) ?>
    <?= $form->field($model, 'script_type')->dropDownList($model->getScriptTypeOptions(), ['prompt'=>'Select Script Type', 'disabled'=>'disabled']) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'content',['options'=>['style'=>'display: none']])->textarea(['rows' => 6]) ?>

    <?php if($model->script_type === 1): ?>
        <div id="script-editor" style="height: 360px; width: 100%; border: 1px solid #DDDDDD; margin-bottom: 10px">
        </div>
    <?php endif; ?>

    <?php if($model->script_type === 0): ?>
        <?= $form->field($model, 'url',['options'=>['id'=>'script-url']])->textInput(['maxlength' => 255]) ?>
        <?= $form->field($model, 'depend', ['options'=>['id'=>'script-depend']])->checkbox([], false) ?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->checkbox([],false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
if($model->script_type === 1){
    $js = <<<JS

        var editor = ace.edit('script-editor'),
            content = $("#script-content").val();

        document.getElementById('script-editor').style.fontSize='14px';
        editor.setTheme('ace/theme/clouds');
        if($("#script-type").val() === "JS"){
            editor.getSession().setMode('ace/mode/javascript');
        }else{
            editor.getSession().setMode('ace/mode/css');
        }
        editor.setValue(content, -1);
        editor.getSession().on('change', function() {
            $("#script-content").html(editor.getSession().getValue());
        });

JS;

    $this->registerJs($js, $this::POS_END, 'aceditor');
}
?>
