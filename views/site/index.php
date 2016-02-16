<?php
use app\models\Client;
use app\models\Priority;
use app\models\User;
use kartik\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\task\DashboardSearch */

$this->title = 'Dashboard';
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать задачу', ['task/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'priority',
                'format'=>'raw',
                'value' => function ($data) {
                    return Priority::getPriorityLabel($data->priority);
                },
                'label' => 'Приоритет',
                'filter' => Priority::getItems()
            ],
            'title',
            [
                'attribute' => 'client_id',
                'value' => 'client.username',
                'filter' => ArrayHelper::map(Client::findAll(['status' => Client::STATUS_ACTIVE, 'type' => Client::TYPE_CLIENT]), 'id', 'username'),
                'label' => 'Клиент'
            ],
            [
                'attribute' =>'user_id',
                'value' => function($data) {return User::getUsernameById($data->user_id);},
                'filter' => User::getUserOptions(),
            ],
            'expected_profit',
            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function($data) {
                    /* @var $data \app\models\Task */
                    return $data->getThemedDate();
                }
            ],
            [
                'format' => 'raw',
                'value' => function ($data) { return Html::a('Подробно', ['task/view', 'id' => $data->id]); }
            ],
        ],
    ]); ?>

</div>
