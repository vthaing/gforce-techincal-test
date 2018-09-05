<?php

use yii\db\Migration;

/**
 * Class m180904_185339_create_bug_report_table_structure
 */
class m180904_185339_create_bug_report_table_structure extends Migration
{

  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('bug_report', [
        'id' => $this->primaryKey(11),
        'name' => $this->string(255)->notNull(),
        'email' => $this->string(255)->notNull(),
        'issue_description' => $this->text()->notNull(),
        'user_id' => $this->integer(),
        'screenshot' => $this->string(255),
        'created_at' => $this->timestamp()
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function down() {
    $this->dropTable('bug_report');
  }
}
