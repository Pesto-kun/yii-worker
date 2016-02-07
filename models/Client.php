<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property integer $status
 * @property string $username
 * @property string $type
 * @property string $typeLabel
 * @property string $description
 * @property string $requisites
 *
 * @property Contact[] $contacts
 */
class Client extends \yii\db\ActiveRecord
{
    const TYPE_CLIENT = 'client';
    const TYPE_CONTRACTOR = 'contractor';

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;

    static $_types = array(
        self::TYPE_CLIENT => 'Клиент',
        self::TYPE_CONTRACTOR => 'Подрядчик',
    );

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['username', 'type'], 'required'],
            [['description', 'type', 'requisites'], 'string'],
            [['username'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Активен',
            'username' => 'ФИО / Название',
            'type' => 'Тип клиента',
            'description' => 'Подробно',
            'requisites' => 'Реквизиты',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['client_id' => 'id']);
    }

    static public function getClientTypeName($type) {
        return isset(self::$_types[$type]) ? self::$_types[$type] : '';
    }
}
