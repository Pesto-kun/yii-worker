<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_151533_add_contanct_info_column extends Migration
{
    protected $tableName = 'contact';

    public function up()
    {
        $this->addColumn($this->tableName, 'comment', 'varchar(255) AFTER `value`');
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'comment');
    }

}
