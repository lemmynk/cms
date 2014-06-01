<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;
use backend\assets\AcEditorAsset;
use yii\web\View;

AcEditorAsset::register($this);

/**
 * @var yii\web\View $this
 * @var backend\models\Template $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'template_form')->textarea(['rows' => 6, 'style' =>'display:none']) ?>

    <div id="tpl-editor" style="height: 360px; width: 100%; border: 1px solid #DDDDDD; margin-bottom: 10px">
    </div>

    <?= $form->field($model, 'status')->checkbox([], false) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS

    var editor = ace.edit('tpl-editor'),
        content = $("#template-template_form").val();
    document.getElementById('tpl-editor').style.fontSize='14px';
    editor.setTheme('ace/theme/clouds');
    editor.getSession().setMode('ace/mode/html');
    editor.setValue(content, -1);
    editor.getSession().on('change', function() {
        $("#template-template_form").html(editor.getSession().getValue());
    });

JS;

$this->registerJs($js, $this::POS_END, 'aceditor');
 ?>
