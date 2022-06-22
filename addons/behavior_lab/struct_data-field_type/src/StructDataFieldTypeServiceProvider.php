<?php namespace BehaviorLab\StructDataFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class StructDataFieldTypeServiceProvider
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       BehaviorLab\StructDataFieldType
 */
class StructDataFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/structured_data-field_type/choose/{field}' => 'BehaviorLab\StructDataFieldType\Http\Controller\StructuredDataController@choose',
        'streams/struct_data-field_type/form/{field}/{extension}' => 'BehaviorLab\StructDataFieldType\Http\Controller\StructuredDataController@form',
        'admin/page_struct_data/save/{structured_datum_id}' => 'BehaviorLab\StructDataFieldType\Http\Controller\Admin\StructuredDataController@save',
    ];
}
