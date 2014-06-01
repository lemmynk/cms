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

$type = $model->isNewRecord ? 'display: none' : '';
?>

<div class="script-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypeOptions(), ['prompt'=>'Select Type']) ?>
    <?= $form->field($model, 'script_type')->dropDownList($model->getScriptTypeOptions(), ['prompt'=>'Select Script Type']) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'content',['options'=>['style'=>'display: none']])->textarea(['rows' => 6]) ?>

    <div id="script-editor" style="display: none; height: 360px; width: 100%; border: 1px solid #DDDDDD; margin-bottom: 10px">
    </div>

    <?= $form->field($model, 'url',['options'=>['id'=>'script-url', 'style'=>'display: none']])->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'depend', ['options'=>['id'=>'script-depend', 'style'=>'display: none']])->checkbox([], false) ?>

    <?= $form->field($model, 'status')->checkbox([],false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS
$("#script-script_type").on("change", function(){
    if(parseInt($(this).val()) === 1){
        $("#script-editor").show();
        $("#script-url").hide();
        $("#script-depend").hide();
    }else if(parseInt($(this).val()) === 0){
        $("#script-url").show();
        $("#script-depend").show();
        $("#script-editor").hide();
    }else{
        $("#script-url").hide();
        $("#script-depend").hide();
        $("#script-editor").hide();
    }
});
JS;

$js = <<<JS

    var editor = ace.edit('script-editor'),
        type = $("#script-type"),
        content = $("#script-content").val();

    document.getElementById('script-editor').style.fontSize='14px';
    editor.setTheme('ace/theme/clouds');
    type.on("change", function(){
        if($(this).val() === "JS"){
                editor.getSession().setMode('ace/mode/javascript');
        }else if($(this).val() === "CSS"){
                editor.getSession().setMode('ace/mode/css');
        }else{
            editor.getSession().setMode('ace/mode/text');
        }
    });
    editor.setValue(content, -1);
    editor.getSession().on('change', function() {
        $("#script-content").html(editor.getSession().getValue());
    });

JS;

$this->registerJs($js, $this::POS_END, 'aceditor');
$this->registerJs($script, $this::POS_END, 'script-toggle');
?>
