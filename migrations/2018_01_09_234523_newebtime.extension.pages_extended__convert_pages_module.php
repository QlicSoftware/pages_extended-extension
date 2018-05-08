<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class NewebtimeExtensionPagesExtendedConvertPagesModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Translatable Slug
        $stream = $this->streams()->findBySlugAndNamespace('pages', 'pages');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', true)->save();

        $field  = $this->fields()->findBySlugAndNamespace('path', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', true)->save();

        // Cache
        $ttl = $this->fields()->create([
            'en' => [
                'name'         => 'newebtime.extension.pages_extended::field.ttl.name',
                'placeholder'  => 'newebtime.extension.pages_extended::field.ttl.name',
                'instructions' => 'newebtime.extension.pages_extended::field.ttl.instructions'
            ],
            'namespace' => 'pages',
            'slug'      => 'ttl',
            'type'      => 'anomaly.field_type.integer',
            'config'    => [
                'min'  => 0,
                'step' => 1,
            ],
            'locked'    => 1
        ]);

        $this->assignments()->create([
            'stream_id' => $stream->getId(),
            'field_id'  => $ttl->getId(),
        ]);

        $cacheType = $this->fields()->create([
            'en' => [
                'name'         => 'newebtime.extension.pages_extended::field.cache_type.name',
                'placeholder'  => 'newebtime.extension.pages_extended::field.cache_type.name',
                'instructions' => 'newebtime.extension.pages_extended::field.cache_type.instructions'
            ],
            'namespace' => 'pages',
            'slug'      => 'cache_type',
            'type'      => 'anomaly.field_type.select',
            'config'    => [
                'default_value' => 'none',
                'options'       => [
                    'none'    => 'newebtime.extension.pages_extended::field.cache_type.option.none',
                    'partial' => 'newebtime.extension.pages_extended::field.cache_type.option.partial',
                    'full'    => 'newebtime.extension.pages_extended::field.cache_type.option.full',
                    'static'  => 'newebtime.extension.pages_extended::field.cache_type.option.static',
                ],
            ],
            'locked'    => 1
        ]);

        $this->assignments()->create([
            'stream_id' => $stream->getId(),
            'field_id'  => $cacheType->getId(),
            'required'  => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function down()
    {
        // Translatable Slug
        $stream = $this->streams()->findBySlugAndNamespace('pages', 'pages');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', false)->save();

        $field  = $this->fields()->findBySlugAndNamespace('path', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $assignment->setAttribute('translatable', false)->save();

        // Cache
        $ttl = $this->fields()->findBySlugAndNamespace('ttl', 'pages');
        $ttl->delete();

        $cacheType = $this->fields()->findBySlugAndNamespace('cache_type', 'pages');
        $cacheType->delete();
    }
}
