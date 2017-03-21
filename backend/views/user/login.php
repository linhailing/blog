<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use backend\services\UrlService;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<?php $form = ActiveForm::begin(['id' => 'login-form', 'options'=> ['class'=>'form-signin']]); ?>
    <div class="form-signin-heading text-center">
        <h1 class="sign-title">Sign In</h1>
        <img src="<?=UrlService::buildUrl('static/images/login-logo.png');?>" alt=""/>
    </div>
    <div class="login-wrap">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class'=>'form-control', 'placeholder'=>'username']) ?>
        <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'placeholder'=>'Password']); ?>

        <button class="btn btn-lg btn-login btn-block" type="submit">
            <i class="fa fa-check"></i>
        </button>
        <label class="checkbox">
            <input type="checkbox" value="1" name="LoginForm[rememberMe]"> Remember me
            <span class="pull-right">
                <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

            </span>
        </label>

    </div>
<?php ActiveForm::end(); ?>
