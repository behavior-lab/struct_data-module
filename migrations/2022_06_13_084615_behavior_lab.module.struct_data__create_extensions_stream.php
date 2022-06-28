<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class BehaviorLabModuleStructDataCreateExtensionsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'extensions',
        'title_column' => 'provider',
        'translatable' => false,
        'trashable'    => false,
        'searchable'   => false,
        'sortable'     => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'provider',
    ];
}
