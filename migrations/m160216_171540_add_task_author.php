<?php

use yii\db\Migration;

class m160216_171540_add_task_author extends Migration
{
    protected $tableName = '{{task}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'user_id', $this->integer() . ' AFTER `date`');
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'user_id');
    }

}
