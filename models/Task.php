<?php

namespace app\models;

use DateTime;
use kartik\helpers\Html;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $closed
 * @property integer $client_id
 * @property string $title
 * @property integer $date
 * @property integer $priority
 * @property integer $expected_profit
 * @property integer $result_profit
 * @property string $description
 *
 * @property Client $client
 * @property Comment[] $comments
 * @property Contractor[] $contractors
 */
class Task extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;    //Задача активна
    const STATUS_CLOSED = 0;    //Задача закрыта
    const STATUS_PAUSE = 2;     //Задача на паузе

    //Сроки задачи
    const PERIOD_WARNING = 86400;   //Время с которого задача помечается как важная
    const PERIOD_SUCCESS = 604800;  //Время до которого задача помечается как "полно времени на выполнение"

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created', 'updated', 'closed', 'client_id', 'expected_profit', 'result_profit', 'priority'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['priority'], 'number', 'min' => 0, 'max' => 9],
            [['date'], 'validateDate'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'created' => 'Создано',
            'updated' => 'Обновлено',
            'closed' => 'Закрыто',
            'client_id' => 'ID клиента',
            'title' => 'Название задачи',
            'date' => 'Дата завершения',
            'expected_profit' => 'Ожидаемая прибыль',
            'result_profit' => 'Прибыль по факту',
            'description' => 'Описание',
        ];
    }

    public function validateDate($attribute, $params)
    {
        if(!preg_match('/^\d{2}\.\d{2}\.\d{4}\s\d{2}:\d{2}$/', $this->$attribute)) {
            $this->addError($attribute, 'Неверный формат даты. Дата дожна быть в формате 01.01.2015 12:00.');
        }
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ],
                'value' => function() { return date('U');},
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractors()
    {
        return $this->hasMany(Contractor::className(), ['task_id' => 'id']);
    }

    public function beforeSave($insert) {
        $dateFrom = DateTime::createFromFormat('d.m.Y H:i', $this->date);
        $this->date = $dateFrom->getTimestamp();
        return parent::beforeSave($insert);
    }

    public function getThemedDate() {
        $current = time();
        if($this->date < $current) {
            return Html::tag('span', Yii::$app->formatter->asDatetime($this->date), ['class' => 'alert-danger']);
        } elseif($this->date < ($current + (60*60*24))) {
            return Html::tag('span', Yii::$app->formatter->asDatetime($this->date), ['class' => 'alert-warning']);
        } elseif($this->date > ($current + (60*60*24*7))) {
            return Html::tag('span', Yii::$app->formatter->asDatetime($this->date), ['class' => 'alert-success']);
        } else {
            return Html::tag('span', Yii::$app->formatter->asDatetime($this->date), ['class' => 'alert-info']);
        }
    }

    //    public function load($data, $formName = NULL) {
//
//        if(parent::load($data, $formName)) {
//
//            if($data['Task']['date']) {
//                $parts = explode('-', $data['Task']['date']);
//                $this->setAttribute('date', mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));
//            }
//
//            return true;
//        }
//
//        return false;
//    }
}
