<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
        'columns' => [
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function ($data) {
                    return $data->status === 1 ?
                        '<span class="label label-success">Активен</span>' :
                        '<span class="label label-danger">Неактивен</span>';},
                'label' => 'Статус'
            ],
            'username',
            'typeLabel',
            'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>

</div>
