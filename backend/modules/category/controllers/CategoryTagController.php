<?php

namespace backend\modules\category\controllers;

use backend\modules\category\models\CategoryTag;
use backend\modules\category\models\CategoryTagSearch;
use backend\modules\tag\models\Tag;
use yii\base\BaseObject;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CategoryTagController implements the CRUD actions for CategoryTag model.
 */
class CategoryTagController extends Controller
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
     * Lists all CategoryTag models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CategoryTagSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryTag model.
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
     * Creates a new CategoryTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($category_id = null)
    {
        $post = \Yii::$app->request->post('CategoryTag');

        $model = new CategoryTag();

        if (!empty($category_id)) {
            $model->category_id = $category_id;
        }

        if (!empty($post)) {
            $tag_id_arr = ArrayHelper::getValue($post, 'tag_id');
            $category_id = $post['category_id'];

            if (!empty($tag_id_arr)) {
                foreach ($tag_id_arr as $tag_id) {

                    if ($this->checkForTag($tag_id, $category_id)) {
                        continue;
                    }
                    $emtModel = new CategoryTag();
                    $emtModel->category_id = $category_id;
                    $emtModel->tag_id = $tag_id;

                    if (!$emtModel->save()) {
                        return $this->render('create', [
                            'model' => $emtModel,
                        ]);
                    }
                }
                return $this->redirect(['category/view', 'id' => $category_id]);
            } else {
                $emtModel = new CategoryTag();
                $emtModel->category_id = $category_id;
                $emtModel->tag_id = $tag_id_arr;
                $emtModel->validate();

                return $this->redirect(['category/view', 'id' => $category_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoryTag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $category_id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if ($category_id !== null) {
                return $this->redirect(['category/view', 'id' => $category_id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoryTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $category_id)
    {
        $this->findModel($id)->delete();

        if ($category_id !== null) {
            return $this->redirect(['category/view', 'id' => $category_id]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoryTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CategoryTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryTag::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function checkForTag($tag_id, $category_id): bool
    {
        return CategoryTag::find()
            ->where(['category_id' => $category_id])
            ->andWhere(['tag_id' => $tag_id])
            ->exists();
    }

}
