<?php
use app\models\Client;
use app\models\Priority;
use app\models\Task;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\task\DashboardSearch */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function ($data) {
                    return Task::getStatusLabel($data->status);
                },
                'label' => 'Статус',
                'filter' => Task::getStatuses()
            ],
            [
                'attribute' => 'priority',
                'format'=>'raw',
                'value' => function ($data) {
                    return \app\models\Priority::getPriorityLabel($data->priority);},
                'label' => 'Приоритет',
                'filter' => Priority::getItems()
            ],
            [
                'attribute' => 'client_id',
                'value' => 'client.username',
                'filter' => ArrayHelper::map(Client::findAll(['status' => Client::STATUS_ACTIVE, 'type' => Client::TYPE_CLIENT]), 'id', 'username'),
                'label' => 'Клиент'
            ],
            'title',
            'created:datetime',
            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function($data) {
                    /* @var $data \app\models\Task */
                    return $data->getThemedDate();
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
