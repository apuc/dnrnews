<?php

namespace backend\modules\news\controllers;

use backend\modules\news\models\CategoryNews;
use backend\modules\news\models\CategoryNewsSearch;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CategoryNewsController implements the CRUD actions for CategoryNews model.
 */
class CategoryNewsController extends Controller
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
     * Lists all CategoryNews models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CategoryNewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryNews model.
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
     * Creates a new CategoryNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($news_id = null)
    {
        $post = \Yii::$app->request->post('CategoryNews');

        $model = new CategoryNews();

        if (!empty($news_id)) {
            $model->news_id = $news_id;
        }

        if (!empty($post)) {
            $category_id_arr = ArrayHelper::getValue($post, 'category_id');
            $news_id = $post['news_id'];

            if (!empty($category_id_arr)) {
                foreach ($category_id_arr as $category_id) {

                    if ($this->checkForCategory($news_id, $category_id)) {
                        continue;
                    }
                    $emtModel = new CategoryNews();
                    $emtModel->category_id = $category_id;
                    $emtModel->news_id = $news_id;

                    if (!$emtModel->save()) {
                        return $this->render('create', [
                            'model' => $emtModel,
                        ]);
                    }
                }
                return $this->redirect(['news/view', 'id' => $news_id]);
            } else {
                $emtModel = new CategoryNews();
                $emtModel->news_id = $news_id;
                $emtModel->category_id = null;
                $emtModel->validate();

                return $this->redirect(['news/view', 'id' => $news_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoryNews model.
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
     * Deletes an existing CategoryNews model.
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
     * Finds the CategoryNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CategoryNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryNews::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function checkForCategory($news_id, $category_id): bool
    {
        return CategoryNews::find()
            ->where(['category_id' => $category_id])
            ->andWhere(['news_id' => $news_id])
            ->exists();
    }
}
