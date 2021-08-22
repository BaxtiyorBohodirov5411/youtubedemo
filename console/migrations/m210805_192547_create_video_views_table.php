<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video_views}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%videos}}`
 * - `{{%user}}`
 */
class m210805_192547_create_video_views_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video_views}}', [
            'id' => $this->primaryKey(),
            'video_id' => $this->string(16)->notNull(),
            'user_id' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `video_id`
        $this->createIndex(
            '{{%idx-video_views-video_id}}',
            '{{%video_views}}',
            'video_id'
        );

        // add foreign key for table `{{%videos}}`
        $this->addForeignKey(
            '{{%fk-video_views-video_id}}',
            '{{%video_views}}',
            'video_id',
            '{{%videos}}',
            'video_id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-video_views-user_id}}',
            '{{%video_views}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-video_views-user_id}}',
            '{{%video_views}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%videos}}`
        $this->dropForeignKey(
            '{{%fk-video_views-video_id}}',
            '{{%video_views}}'
        );

        // drops index for column `video_id`
        $this->dropIndex(
            '{{%idx-video_views-video_id}}',
            '{{%video_views}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-video_views-user_id}}',
            '{{%video_views}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-video_views-user_id}}',
            '{{%video_views}}'
        );

        $this->dropTable('{{%video_views}}');
    }
}
