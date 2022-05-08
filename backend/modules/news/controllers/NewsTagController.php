<?php

namespace backend\modules\news\controllers;

use backend\modules\category\models\CategoryTag;
use backend\modules\news\models\CategoryNews;
use backend\modules\news\models\NewsTag;
use backend\modules\news\models\NewsTagSearch;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * NewsTagController implements the CRUD actions for NewsTag model.
 */
class NewsTagController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all NewsTag models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewsTagSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewsTag model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NewsTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($news_id = null)
    {
        $post = \Yii::$app->request->post('NewsTag');

        $model = new NewsTag();

        if (!empty($news_id)) {
            $model->news_id = $news_id;
        }

        if (!empty($post)) {
            $tag_id_arr = ArrayHelper::getValue($post, 'tag_id');
            $news_id = $post['news_id'];

            if (!empty($tag_id_arr)) {
                foreach ($tag_id_arr as $tag_id) {

                    if ($this->checkForTag($news_id, $tag_id)) {
                        continue;
                    }
                    $emtModel = new NewsTag();
                    $emtModel->tag_id = $tag_id;
                    $emtModel->news_id = $news_id;

                    if (!$emtModel->save()) {
                        return $this->render('create', [
                            'model' => $emtModel,
                        ]);
                    }
                }
                return $this->redirect(['news/view', 'id' => $news_id]);
            } else {
                $emtModel = new NewsTag();
                $emtModel->news_id = $news_id;
                $emtModel->tag_id = null;
                $emtModel->validate();

                return $this->redirect(['news/view', 'id' => $news_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NewsTag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $news_id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if ($news_id !== null) {
                return $this->redirect(['news/view', 'id' => $news_id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NewsTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $news_id)
    {
        $this->findModel($id)->delete();

        if ($news_id !== null) {
            return $this->redirect(['news/view', 'id' => $news_id]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the NewsTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return NewsTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsTag::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function checkForTag($news_id, $tag_id): bool
    {
        return NewsTag::find()
            ->where(['tag_id' => $tag_id])
            ->andWhere(['news_id' => $news_id])
            ->exists();
    }
}
