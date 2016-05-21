<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use lav45\widget\AjaxCreate;

$this->title = 'Language';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-index">

    <?php AjaxCreate::begin(); ?>

    <div class="clearfix">
        <h2 class="pull-left">
            <?= Html::encode($this->title) ?>
        </h2>
        <div class="pull-right">
            <?= Html::button('<span class="glyphicon glyphicon-plus"></span>', [
                'data-href' => Url::toRoute(['create']),
                'class' => 'btn btn-success vertical-center',
                'title' => 'Create',
            ]) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'locale',
            'name',

            [
                'attribute' => 'status',
                'value' => 'statusName',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function() {
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', [
                            'data-href' => Url::toRoute(['update', 'id' => func_get_arg(2)]),
                            'class' => 'btn btn-xs btn-default',
                            'title' => 'Update',
                        ]);
                    },
                    'delete' => function() {
                        /** @var \common\models\Lang $model */
                        $model = func_get_arg(1);

                        $config = [
                            'title' => 'Delete',
                            'disabled' => $model->isSourceLanguage(),
                            'class' => 'btn btn-xs btn-default',
                        ];

                        if ($model->isSourceLanguage()) {
                            $url = 'javascript:void(0)';
                        } else {
                            $url = Url::toRoute(['delete', 'id' => func_get_arg(2)]);
                            $config['data-confirm'] = 'Are you sure you want to delete this item?';
                            $config['data-method'] = 'post';
                            $config['data-pjax'] = '0';
                        }

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $config);
                    }
                ]
            ],
        ],
    ]); ?>

    <?php AjaxCreate::end(); ?>

</div>
