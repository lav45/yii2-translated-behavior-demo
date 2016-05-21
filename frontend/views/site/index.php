<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Post
 * @var $menu array
 */

use yii\bootstrap\Html;

$this->title = $model->title;

$description = str_replace('%7Blang%7D', $model->language, $model->description);

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                <?php foreach ($menu as $slug => $name): ?>
                    <?= Html::a($name, ['view', 'slug' => $slug], [
                        'class' => 'list-group-item list-group-xs' .
                            ($model->slug == $slug ? ' active' : '')
                    ]) ?>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="col-sm-9">
                <?= $description ?>
            </div>
        </div>

    </div>
</div>
