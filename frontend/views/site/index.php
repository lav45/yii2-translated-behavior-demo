<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Post
 */

$this->title = $model->title;

$description = str_replace('%7Blang%7D', $model->language, $model->description);

?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?= $description ?>
            </div>
        </div>
    </div>
</div>
