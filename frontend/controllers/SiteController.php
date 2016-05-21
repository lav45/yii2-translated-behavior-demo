<?php
namespace frontend\controllers;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Post;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->actionView('readme');
    }

    public function actionView($slug)
    {
        return $this->render('index', [
            'model' => $this->getModel($slug),
            'menu' => $this->getMenu(),
        ]);
    }

    /**
     * @return array
     */
    protected function getMenu()
    {
        $menu = Post::find()
            ->with([
                'currentTranslate' => function(ActiveQuery $q) {
                    $q->select(['post_id', 'lang_id', 'title']);
                }
            ])
            ->orderBy(['slug' => SORT_ASC])
            ->all();

        return ArrayHelper::map($menu, 'slug', 'title');
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function getModel($slug)
    {
        if (($model = Post::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }
}
