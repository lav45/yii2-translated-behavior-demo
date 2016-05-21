<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\SignInAsset;

/**
 * @var $this yii\web\View
 * @var $model \common\models\LoginForm
 */

$this->title = 'Login';

SignInAsset::register($this);

?>
<?php $form = ActiveForm::begin([
	'options' => ['class' => 'form-signin'],
	'layout' => 'default',
]);?>
	<h2 class="form-signin-heading"><?= Html::encode($this->title) ?></h2>
	<?= $form->field($model, 'username')->input('text', ['placeholder' => 'login', 'autofocus'=>'autofocus'])->label(false) ?>
	<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'password'])->label(false) ?>
	<?= $form->field($model, 'rememberMe')->checkbox() ?>
	<?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'login-button']) ?>
<?php ActiveForm::end(); ?>
