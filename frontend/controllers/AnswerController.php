<?php

namespace frontend\controllers;

use Yii;
use common\models\Answer;
use common\models\AnswerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnswerController implements the CRUD actions for Answer model.
 */
class AnswerController extends Controller
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
     * Creates a new Answer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Answer();

		if(empty($model->created_date)) { $model->created_date=date('Y-m-d H:i:s'); }

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question/view', 'id' => $model->question_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Answer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $mcAnswer = $this->findModel($id);

        if($mcAnswer->user_id==yii::$app->user->identity->id)
		{
			if ($mcAnswer->load(Yii::$app->request->post()) && $mcAnswer->save()) {
				\Yii::$app->getSession()->setFlash('success', 'Answer updated successfully.');
				return $this->redirect(['question/view', 'id' => $mcAnswer->question_id]);
			}

			return $this->render('update', [
				'mvAnswer' => $mcAnswer, 'vQuestionId' => $mcAnswer->question_id,
			]);
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');;
		}
    }

    /**
     * Deletes an existing Answer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
		
		$model = $this->findModel($id);
		$model->status='0';
		if($model->save())
		{
			\Yii::$app->getSession()->setFlash('success', 'Answer deleted successfully.');
			$this->redirect(['question/view', 'id' => $model->question_id]);
		}
    }

    /**
     * Finds the Answer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Answer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Answer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
