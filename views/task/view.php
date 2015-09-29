<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту задачу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'status',
                'label'=>'Статус',
                'format'=>'raw',
                'value'=>$model->status ?
                    '<span class="label label-success">Открыто</span>' :
                    '<span class="label label-danger">Закрыто</span>',
            ],
            [
                'attribute' => 'client.username',
                'label' => 'Клиент'
            ],
            'date:datetime',
            'expected_profit',
            'result_profit',
            'description:ntext',
        ],
    ]) ?>

    <h2>Комментарии</h2>
    <p><?= Html::a('Добавить комментарий', ['comment/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>

    <ul class="list-group">
        <?php
        $comments = $model->comments;
        if($comments) {
            foreach($comments as $_comment) {
                echo '<li class="list-group-item">'.$_comment->text.'</li>';
            }
        }
        ?>
    </ul>

</div>
