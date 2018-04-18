<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'only' => ['index','create','update','view'],
                        'rules' => [
                            // allow authenticated users
                            [
                                'allow' => true,
                                'roles' => ['admin'],
                            ],
                            // everything else is denied
                        ],
            ], 
			'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
		$userValues = Yii::$app->request->post('User');
		$authKey = $userValues['auth_key'];
		if(!empty($userValues)){
			if(!empty($authKey)){
			$_POST ['User']['auth_key'] = Yii::$app->security->generateRandomString();
			$_POST ['User']['password_hash'] = Yii::$app->security->generatePasswordHash($authKey);
			}
			$_POST ['User']['password_reset_token'] = NULL;
		}
        if ($model->load($_POST) && $model->save()) {	
            return $this->redirect(['view','id'=>$model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if(!empty(Yii::$app->request->post()))
		{
			$userValues = Yii::$app->request->post('User');	
			if ($model->load($_POST) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionChangepassword()
    {
            $id = \Yii::$app->user->id;
 
			try {
				$model = new \common\models\ChangePasswordForm($id);
			} catch (InvalidParamException $e) {
				throw new \yii\web\BadRequestHttpException($e->getMessage());
			}
		 
			if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
				\Yii::$app->session->setFlash('success', 'Password Changed!');
			}
		 
			return $this->render('changePassword', [
				'model' => $model,
			]);
    }
	
}
