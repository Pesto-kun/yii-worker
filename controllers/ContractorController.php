<?php

namespace app\controllers;

use app\models\Task;
use Yii;
use app\models\Contractor;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractorController implements the CRUD actions for Contractor model.
 */
class ContractorController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Contractor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Contractor();
        $task = Task::findOne($id);
        $model->task_id = $task->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['task/view', 'id' => $task->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'task' => $task,
            ]);
        }
    }

    /**
     * Updates an existing Contractor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $task = Task::findOne($model->task_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['task/view', 'id' => $task->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'task' => $task,
            ]);
        }
    }

    /**
     * Deletes an existing Contractor model.
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
     * Finds the Contractor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contractor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contractor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
