<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use millersoft\widgets\FileUploader;

/**
 * @var yii\web\View $this
 * @var backend\models\File $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->hiddenInput()->label(false) ?>

    <?php ActiveForm::end(); ?>

    <?= FileUploader::widget([
        'model'=>$model,
        'attribute'=>'file',
        'ajaxVar'=>['name']
    ]); ?>

</div>
