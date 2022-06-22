<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class BehaviorLabModuleStructDataCreateStructuredDataStream
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class BehaviorLabModuleStructDataCreateStructuredDataStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'structured_data',
        'title_column' => 'type',
        'translatable' => true,
        'sortable'     => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title'     => [
            'translatable' => true,
        ],
        'area'      => [
            'required' => true,
        ],
        'field'     => [
            'required' => true,
        ],
        'extension' => [
            'required' => true,
        ],
        'entry',
    ];

}
