<?php
use app\models\Client;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\client\Search */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить клиента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function ($data) {
                    return $data->status === 1 ?
                        '<span class="label label-success">Активен</span>' :
                        '<span class="label label-danger">Неактивен</span>';
                },
                'filter' => [
                    Client::STATUS_ACTIVE => 'Активен',
                    Client::STATUS_DISABLE => 'Неактивен',
                ]
            ],
            'username',
            [
                'attribute' => 'type',
                'value' => function($data) {
                    return Client::getClientTypeName($data->type);
                },
                'filter' => Client::$_types
            ],
            'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>

</div>
