<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Lang
 */

use yii\helpers\Html;

$this->title = 'Create Language';
$this->params['breadcrumbs'][] = ['label' => 'Language', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
