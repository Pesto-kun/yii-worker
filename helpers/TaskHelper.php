<?php
/**
 * @author pest (pest11s@gmail.com)
 */

namespace app\helpers;

use app\models\Task;

class TaskHelper {

    static public function getStatusLabelClass($status) {
        switch($status) {
            case Task::STATUS_ACTIVE:
                return 'success';
            case Task::STATUS_CLOSED:
                return 'danger';
            case Task::STATUS_PAUSE:
                return 'info';
            default:
                return 'default';
        }
    }
}