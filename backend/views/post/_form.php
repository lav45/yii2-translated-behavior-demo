<?php

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use vova07\imperavi\Widget as Imperavi;

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

    <?= $form->field($model, 'description', ['inputTemplate' => $inputTemplate])->widget(Imperavi::class, [
        'settings' => [
            'minHeight' => 200,
            'buttonSource' => true,
            'replaceDivs' => false,
            'toolbarFixed' => false,
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

            <?php if($model->isTranslated()): ?>
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Translate',
                    ['delete-translate', 'id' => $model->id, 'lang_id' => $model->language],
                    [
                        'class' => 'btn btn-default',
                        'title' => 'Delete translate',
                        'data-confirm' => 'Are you sure you want to delete translate for this item?',
                        'data-pjax' => '0',
                    ]
                ) ?>
            <?php endif; ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
