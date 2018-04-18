<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
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
                        'only' => ['view','dashboard','editprofile','changepassword'],
                        'rules' => [
                             [
								'actions' => ['view'],
								'allow' => true,
								'roles' => ['?'],
							],
							// allow authenticated users
                            [
                                'actions'=>['dashboard','editprofile','changepassword'],
								'allow' => true,
                                'roles' => ['@'],
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
	
	public function actionDashboard()
    {
        return $this->render('dashboard', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
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
	
	public function actionEditprofile()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);
		if(!empty(Yii::$app->request->post()))
		{			
			if ($model->load($_POST) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

        return $this->render('editprofile', [
            'model' => $model,
        ]);
    }
}
