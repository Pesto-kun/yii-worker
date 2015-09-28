<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $client_id
 * @property string $title
 * @property integer $date
 * @property integer $expected_profit
 * @property integer $result_profit
 * @property string $description
 *
 * @property Client $client
 */
class Task extends \yii\db\ActiveRecord
{
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
            [['status', 'created', 'updated', 'closed', 'client_id', 'expected_profit', 'result_profit'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['date'], 'string', 'max' => 10],
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
            'status' => 'Открыто',
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
        if(!preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $this->$attribute)) {
            $this->addError($attribute, 'Неверный формат даты. Дата дожна быть в формате YYYY-MM-DD.');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    //TODO остановился тут 2015-09-28 09:11
//    public function load($data, $formName = NULL) {
//
//        if(parent::load($data, $formName)) {
//
//            if($data['Task']['date']) {
//                $parts = explode('-', $data['date']);
//                $this->setAttribute('date', mktime(0, 0, 0, $parts[1], $parts[0], $parts[2]));
//            }
//
//            return true;
//        }
//
//        return false;
//    }
}
