<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var backend\models\Assign $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="assign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page_id')->hiddenInput(['value'=>$pageId])->label(false) ?>
    <?= $form->field($model, 'assign_type')->hiddenInput(['value'=>$assignType])->label(false) ?>
    <?= $form->field($model, 'sector_id')->dropDownList(backend\models\TemplateSector::getSectorsOptions($assignType), ['prompt'=>'Select sector']) ?>
    <?= $form->field($model, 'content_type')->dropDownList($model->getContentTypeOptions(), ['prompt'=>'Select content type']) ?>
    <?= $form->field($model, 'content_id')->dropDownList([], ['prompt'=>'']) ?>
    <?= $form->field($model, 'order_by')->textInput(['maxlength' => 11]) ?>
    <?= $form->field($model, 'lang_id')->textInput(['maxlength' => 2]) ?>
    <?= $form->field($model, 'status')->checkbox([], false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), $model->isNewRecord ? ['index', 'type'=>$assignType, 'pid'=>$pageId] : ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS
$("#assign-content_type").on("change", function(){
    $.ajax({
        type : 'POST',
        data : {'cid': $(this).val()},
        dataType : 'JSON',
        success : function(data){
            $("#assign-content_id").html(data);
        }
    });
})
JS;

$this->registerJs($script, View::POS_END, 'assign')
?>
