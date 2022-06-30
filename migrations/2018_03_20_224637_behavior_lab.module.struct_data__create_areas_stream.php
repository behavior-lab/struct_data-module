<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class BehaviorLabModuleStructDataCreateAreasStream
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class BehaviorLabModuleStructDataCreateAreasStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'areas',
        'title_column' => 'name',
        'translatable' => true,
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
        'name'        => [
            'translatable' => true,
            'required'     => true,
        ],
        'slug'        => [
            'unique'   => true,
            'required' => true,
        ],
        'description' => [
            'translatable' => true,
        ],
        'structured_data',
    ];

}
