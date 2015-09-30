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
 *
 * @property Contact[] $contacts
 */
class Client extends \yii\db\ActiveRecord
{
    const TYPE_CLIENT = 'client';
    const TYPE_CONTRACTOR = 'contractor';

    public $typeLabel;

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

    public function afterFind() {
        $this->typeLabel = $this->getClientTypeLabel($this->type);
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['username', 'type'], 'required'],
            [['description', 'type'], 'string'],
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
            'type' => 'Тип',
            'description' => 'Подробно',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['client_id' => 'id']);
    }

    public function getClientTypeLabel($type) {
        return isset(self::$_types[$type]) ? self::$_types[$type] : null;
    }
}
