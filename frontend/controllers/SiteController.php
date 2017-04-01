<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Post;
use common\models\Lang;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'languages' => Lang::getLocaleList(),
            ]
        ];
    }

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

    public function actionIndex($_lang = null)
    {
        if($_lang === null) {
            return $this->redirect(['index']);
        } else {
            return $this->actionView('readme');
        }
    }

    public function actionView($slug)
    {
        return $this->render('index', [
            'model' => $this->getModel($slug),
        ]);
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
