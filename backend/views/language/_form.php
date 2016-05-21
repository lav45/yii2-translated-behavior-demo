<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Lang
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

ActiveForm::$autoIdPrefix = 'a';

?>
<div class="lang-form">

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

    <?= $form->field($model, 'id')->textInput([
        'disabled' => $model->isSourceLanguage(),
        'maxlength' => true
    ]) ?>

    <?= $form->field($model, 'locale')->textInput([
        'disabled' => $model->isSourceLanguage(),
        'maxlength' => true
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusList(), [
        'disabled' => $model->isSourceLanguage(),
    ]) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
