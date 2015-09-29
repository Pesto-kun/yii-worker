<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $task app\models\Task */

$this->title = 'Добавить комментарий';
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['task/index']];
$this->params['breadcrumbs'][] = ['label' => $task->title, 'url' => ['task/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Комментарий';
?>
<div class="comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'task' => $task,
    ]) ?>

</div>
