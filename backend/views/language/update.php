<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Lang
 */

use yii\helpers\Html;

$this->title = 'Update Language: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Language', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lang-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
