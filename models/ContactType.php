<?php
/**
 * @company BestArtDesign
 * @site http://bestartdesign.com
 * @author pest (pest11s@gmail.com)
 */

namespace app\models;

use yii\base\Model;

class ContactType extends Model {

    static public $_types = array(
        'phone' => 'Телефон',
        'mail' => 'E-mail',
        'skype' => 'Skype',
        'vk' => 'Вконтакте',
        'fb' => 'Facebook',
    );

    static public function getTypes() {
        return self::$_types;
    }

    static public function getTypeName($type) {
        $types = self::$_types;
        return isset($types[$type]) ? $types[$type] : 'Неизвестно';
    }
}