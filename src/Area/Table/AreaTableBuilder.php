<?php namespace BehaviorLab\StructDataModule\Area\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class AreaTableBuilder
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class AreaTableBuilder extends TableBuilder
{

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'name',
                'slug',
                'description',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'name',
        'slug',
        'description',
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit',
        'structured_data' => [
            'icon' => 'magic',
            'type' => 'primary',
            'href' => 'admin/struct_data/areas/{entry.slug}',
        ],
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete',
    ];

}
