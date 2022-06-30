<?php

use ConductLab\StructDataModule\Type\TypeModel;
use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class BehaviorLabModuleStructDataAddTypeToStructuredData
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class BehaviorLabModuleStructDataAddTypeToStructuredData extends Migration
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
                'related' => TypeModel::class,
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
        'slug' => 'structured_data',
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
