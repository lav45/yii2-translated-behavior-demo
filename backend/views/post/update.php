<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $langList array */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Post', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="post-update">

    <h1><?= Html::encode($this->title) . ' Post ( ' . $model->language . ' )' ?></h1>

    <div class="row">
        <div class="col-sm-10">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
        <div class="col-sm-2">
            <div class="btn-group-vertical pull-right">
                <?php foreach($langList as $lang_id => $lang_name) {
                    $active = $lang_id == $model->language ? ' active' : '';
                    $color = $model->hasTranslate($lang_id) ? 'info' : 'default';
                    $url = Url::current(['lang_id' => $lang_id]);

                    echo Html::a($lang_name, $url, [
                        'class' => 'btn btn-' . $color . $active,
                        'title' => "Update $lang_id version",
                        'data-pjax' => '0',
                    ]);
                } ?>
            </div>
        </div>
    </div>

</div>
