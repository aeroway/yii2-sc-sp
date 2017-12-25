<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
?>

<div class="col-sm-4 col-sm-offset-1">
	<div class="login-form"><!--login form-->
		<h2>Login to your account</h2>
		<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
			<?= $form->field($model, 'username')->textInput(['autofocus' => false, 'placeholder' => 'user name'])->label(false); ?>
			<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'password'])->label(false); ?>
			<?= $form->field($model, 'rememberMe')->checkbox(['class' => '']) ?>
			<div class="form-group">
				<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div><!--/login form-->
</div>
<div class="col-sm-1">
	<h2 class="or">OR</h2>
</div>
<div class="col-sm-4">
	<div class="signup-form"><!--sign up form-->
		<h2>New User Signup!</h2>
		<?php $form = ActiveForm::begin([
					'id' => 'form-signup',
					'action' => Yii::$app->homeUrl . 'site/signup'
		]); ?>
			<?= $form->field($modelRegister, 'username')->textInput(['autofocus' => false, 'placeholder' => 'Username'])->label(false); ?>

			<?= $form->field($modelRegister, 'email')->textInput()->input('email', ['placeholder' => "Enter Your Email"])->label(false); ?>

			<?= $form->field($modelRegister, 'password')->passwordInput(['placeholder' => 'Password'])->label(false); ?>

			<div class="form-group">
				<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div><!--/sign up form-->
</div>