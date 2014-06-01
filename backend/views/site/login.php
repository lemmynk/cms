<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \common\models\LoginForm $model
 */
$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options'=>['class'=>'form-signin', 'focus']]); ?>

        <h2 class="form-signin-heading"><?= Html::encode($this->title) ?></h2>

        <?= $form->field($model, 'username', ['inputOptions'=>['placeholder'=>'Username', 'class'=>'form-control']])->textInput()->label(false) ?>
        <?= $form->field($model, 'password', ['inputOptions'=>['placeholder'=>'Password', 'class'=>'form-control']])->passwordInput()->label(false) ?>
        <?= $form->field($model, 'rememberMe')->checkbox(['checked'=>'unchecked']) ?>
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
