<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\Subscribe;
use app\models\LoginForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/*++*/
use app\models\Category;
use app\models\User;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update'],
                'rules' => [
                    // разрешаем аутентифицированным пользователям
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // всё остальное по умолчанию запрещено
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){ //пользователь не авторизован
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }

            return $this->render('//site/login', [
                'model' => $model,
            ]);//return $this->render('not_register');
        };

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()
                ->where(['author_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => ['publish_date' => SORT_DESC],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'addPost' => true,
            'withAuthor' => false,
            'author' => Yii::$app->user->identity,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        $model->author_id = Yii::$app->user->id; /* ++ */

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'category' => Category::find()->all()
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'category' => Category::find()->all()
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getPostsByAuthor($id){
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['author_id' => $id]),
        ]);
    }

    public function actionFeed()
    {
        $current_user_id = (Yii::$app->user->isGuest) ? 0 : Yii::$app->user->id;

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where([
                'author_id' => Subscribe::getAuthorsFeed($current_user_id)
            ]),
            'sort' => [
                'defaultOrder' => ['publish_date' => SORT_DESC],
            ],
        ]);

        return $this->render('feed', [
            'dataProvider' => $dataProvider,
            'addPost' => false,
            'withAuthor' => true,
        ]);

    }

}