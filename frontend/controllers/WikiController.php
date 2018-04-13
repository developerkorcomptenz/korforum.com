<?php

namespace frontend\controllers;

use Yii;
use common\models\Wiki;
use common\models\WikiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WikiController implements the CRUD actions for Wiki model.
 */
class WikiController extends Controller
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
     * Lists all Wiki models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WikiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wiki model.
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
     * Creates a new Wiki model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wiki();
        // print_r(Yii::$app->request->post());exit;
        $this->uploadedFile($model);
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    protected function uploadedFile($model){
        $oldimage = $model->featured_image;
        if ($model->load(Yii::$app->request->post())) {
            $error=array();
            //$extension=array("jpg");
            if(isset($_FILES['Wiki']['name']['featured_image']) && $_FILES['Wiki']['tmp_name']['featured_image']!='') {
                $file_name = $_FILES['Wiki']['name']['featured_image'];
                $file_tmp = $_FILES['Wiki']['tmp_name']['featured_image'];
                $uploadPath = Yii::$app->basePath."\\web\\images\\";
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $random_number = Yii::$app->security->generateRandomString(3);
                if(!empty($file_name)) {
                    $fileName = pathinfo($file_name, PATHINFO_FILENAME) . "_" . $random_number;
                    $newFileName = $fileName . "." . $ext;
                    move_uploaded_file($file_tmp = $_FILES['Wiki']['tmp_name']['featured_image'], $uploadPath . $newFileName);
                    $model->featured_image = $newFileName;
                }
            }
            else{
                $model->featured_image = $oldimage;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }
    /**
     * Updates an existing Wiki model.
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
			/*if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}*/
			$this->uploadedFile($model);
        }
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Wiki model.
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
     * Finds the Wiki model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wiki the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wiki::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
