<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class BehaviorLabModuleStructDataCreateTypesStream
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class BehaviorLabModuleStructDataCreateTypesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'types',
        'title_column' => 'name',
        'translatable' => true,
        'trashable'    => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'category'       => [
            'required' => true,
        ],
        'name'           => [
            'translatable' => true,
            'required'     => true,
            'unique'       => true,
        ],
        'slug'           => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'slugify' => 'name',
                'type'    => '_',
            ],
        ],
        'description'    => [
            'translatable' => true,
        ],
        'content_layout' => [
            'required' => true,
        ],
        'wrapper_layout' => [
            'required' => true,
        ],
    ];

}
