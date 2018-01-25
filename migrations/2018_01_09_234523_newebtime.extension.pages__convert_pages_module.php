<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class NewebtimeExtensionPagesConvertPagesModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stream = $this->streams()->findBySlugAndNamespace('pages', 'pages');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', true)->save();

        $field  = $this->fields()->findBySlugAndNamespace('path', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', true)->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $stream = $this->streams()->findBySlugAndNamespace('pages', 'pages');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', false)->save();

        $field  = $this->fields()->findBySlugAndNamespace('path', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', false)->save();
    }
}
