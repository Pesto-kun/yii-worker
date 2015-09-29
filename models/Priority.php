<?php
/**
 * @company BestArtDesign
 * @site http://bestartdesign.com
 * @author pest (pest11s@gmail.com)
 */

namespace app\models;

class Priority {
    static $_priority = [
        1 => 'Не важно',
        3 => 'Не очень важно',
        5 => 'Обычный',
        7 => 'Важно',
        9 => 'Очень важно',
    ];

    static public function getItems() {
        return self::$_priority;
    }

    static public function getPriorityName($priority) {
        return isset(self::$_priority[$priority]) ? self::$_priority[$priority] : null;
    }

    static public function getPriorityLabel($priority) {
        $class = '';

        if($priority >=8) {
            $class = 'label-danger';
        } elseif($priority >= 7) {
            $class = 'label-warning';
        } elseif($priority >= 5) {
            $class = 'label-success';
        } elseif($priority >= 3) {
            $class = 'label-info';
        } else {
            $class = 'label-default';
        }

        return '<span class="label '.$class.'">'.self::getPriorityName($priority).'</span>';
    }
}