<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use miller\fileuploader\FileUploader;

/**
 * @var yii\web\View $this
 * @var backend\models\File $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'category_id')->hiddenInput()->label(false) ?>

        <?= FileUploader::widget([
            'model'=>$model,
            'attribute'=>'file',
            'ajaxVar'=>['name', 'ext']
        ]); ?>

    <?php ActiveForm::end(); ?>
</div>
