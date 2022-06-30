<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class BehaviorLabModuleStructDataAddDisplayTitleFieldToStructuredData
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class BehaviorLabModuleStructDataAddDisplayTitleFieldToStructuredData extends Migration
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
        'display_title' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
                'mode'          => 'checkbox',
                'label'         => 'conduct_lab.module.structured_data::field.display_title.label',
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
        'display_title',
    ];

}
