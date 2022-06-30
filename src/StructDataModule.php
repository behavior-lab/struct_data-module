<?php namespace ConductLab\StructDataModule;

use ConductLab\StructDataFieldType\StructDataFieldType;
use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class StructDataModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       ConductLab\StructDataModule
 */
class StructDataModule extends Module
{

    /**
     * The sub-addons.
     *
     * @var array
     */
    protected $addons = [
        StructDataFieldType::class,
    ];

    /**
     * The module addon.
     *
     * @var string
     */
    protected $icon = 'fas fa-digital-tachograph';

    /**
     * The navigation flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The module structured_data.
     *
     * @var array
     */
    protected $sections = [
//        'areas'  => [
//            'buttons' => [
//                'new_area',
//            ],
//        ],
//        'structured_data' => [
//            'slug'        => 'structured_data',
//            'data-toggle' => 'modal',
//            'data-target' => '#modal',
//            'data-href'   => 'admin/structured_data/areas/{request.route.parameters.area}',
//            'href'        => 'admin/structured_data/choose',
//            'buttons'     => [
//                'add_structured_datum' => [
//                    'data-toggle' => 'modal',
//                    'data-target' => '#modal',
//                    'href'        => 'admin/structured_data/areas/{request.route.parameters.area}/choose',
//                ],
//            ],
//        ],
        'types'  => [
            'buttons'  => [
                'new_type',
            ],
            'structured_data' => [
                'assignments' => [
                    'hidden'  => true,
                    'href'    => 'admin/structured_data/types/assignments/{request.route.parameters.stream}',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/structured_data/types/assignments/{request.route.parameters.stream}/choose',
                        ],
                    ],
                ],
            ],
        ],
        'fields' => [
            'buttons' => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/structured_data/fields/choose',
                ],
            ],
        ],
        'extensions'  => [
            'buttons' => [
                'new_area',
            ],
        ],
    ];

}
