<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\models\PostSearch */

$this->title = 'Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <div class="clearfix">
        <div class="pull-left">
            <ul class="list-unstyled list-inline">
                <li>
                    <h2><?= Html::encode($this->title) ?></h2>
                </li>
                <li>
                    <?php
                    $text = $searchModel->advancedSearch ? 'Search by all language' : 'Search by current language';
                    $url = Url::current(['advancedSearch' => $searchModel->advancedSearch === false]);
                    echo Html::a($text, $url);
                    ?>
                </li>
            </ul>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success vertical-center']) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
