<?php

use yii\db\Schema;
use yii\db\Migration;

class m160127_145241_add_client_requisites_column extends Migration
{
    protected $tableName = 'client';

    public function up()
    {
        $this->addColumn($this->tableName, 'requisites', $this->text());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'requisites');
    }

}
