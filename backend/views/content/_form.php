<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\CkEditorAsset;
use yii\web\View;

CkEditorAsset::register($this);

/**
 * @var yii\web\View $this
 * @var backend\models\Content $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->checkbox([], false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJs("CKEDITOR.replace( 'content-content' );", $this::POS_END, 'ckeditor'); ?>
