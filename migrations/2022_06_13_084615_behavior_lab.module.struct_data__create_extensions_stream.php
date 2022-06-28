<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class BehaviorLabModuleStructDataCreateExtensionsStream extends Migration
{

    /**
     * Don't delete the stream here
     * it's only for reference use.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'type' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => \BehaviorLab\StructDataModule\Type\TypeModel::class,
            ],
        ],
    ];

    /**
     * The addon stream.
     * This is only for
     * reference for below.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'extensions',
    ];

    /**
     * The addon assignments.
     *
     * @var array
     */
    protected $assignments = [
        'type',
    ];
}
