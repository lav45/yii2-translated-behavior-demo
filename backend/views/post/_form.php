<?php

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use vova07\imperavi\Widget as Redactor;

$translate_flag = '<span class="input-group-addon"><span class="glyphicon glyphicon-flag"></span></span>';
$inputTemplate = '<div class="input-group">{input}' . $translate_flag . '</div>';

?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-10',
            ],
        ],
    ]); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'title', ['inputTemplate' => $inputTemplate])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description', ['inputTemplate' => $inputTemplate])->widget(Redactor::class, [
        'settings' => [
            'minHeight' => 200,
            'buttonSource' => true,
            'replaceDivs' => false,
            'toolbarFixed' => false,
            'imageUpload' => Url::to(['image-upload']),
            'plugins' => [
                'fontsize',
                'definedlinks',
            ],
        ],
    ]) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', 
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
