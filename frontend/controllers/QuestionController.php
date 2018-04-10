<?php

namespace frontend\controllers;

use Yii;
use common\models\Question;
use common\models\QuestionSearch;
use common\models\Answer;
use common\models\AnswerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
                             [
								'actions' => ['index','view'],
								'allow' => true,
								'roles' => ['?'],
							],
							// allow authenticated users
                            [
                                'actions'=>['index','create','update','view'],
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
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['question.status' => 1]);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $mcAnswer = new Answer();

		if(empty($mcAnswer->created_date)) { $mcAnswer->created_date=date('Y-m-d H:i:s'); }

		if ($mcAnswer->load(Yii::$app->request->post()) && $mcAnswer->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Answer added successfully.');
			return $this->redirect(['question/view', 'id' => $mcAnswer->question_id]);
        }
		
        return $this->render('view', [
            'mvQuestion' => $this->findModel($id),'mvAnswer' => $mcAnswer,
        ]);
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Question();
		
		if(empty($model->created_date)) { $model->created_date=date('Y-m-d H:i:s'); }
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->user_id==yii::$app->user->identity->id)
		{
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				\Yii::$app->getSession()->setFlash('success', 'Question updated successfully.');
				return $this->redirect(['view', 'id' => $model->id]);
			}

			return $this->render('update', [
				'model' => $model,
			]);
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       /* $this->findModel($id)->delete();
        return $this->redirect(['index']);*/
		$model = $this->findModel($id);
		$model->status='0';
		if($model->save())
		{
			\Yii::$app->getSession()->setFlash('success', 'Question deleted successfully.');
			$this->redirect(['question/index']);
		}
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
