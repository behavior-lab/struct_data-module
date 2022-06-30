<?php namespace ConductLab\StructDataFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class StructDataFieldTypeServiceProvider
 *
 * @link          https://ConductLab.site/
 * @author        Behavior CPH, ApS <support@ConductLab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       ConductLab\StructDataFieldType
 */
class StructDataFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/structured_data-field_type/choose/{field}' => 'ConductLab\StructDataFieldType\Http\Controller\StructuredDataController@choose',
        'streams/struct_data-field_type/form/{field}/{extension}' => 'ConductLab\StructDataFieldType\Http\Controller\StructuredDataController@form',
        'admin/page_struct_data/save/{structured_datum_id}' => 'ConductLab\StructDataFieldType\Http\Controller\Admin\StructuredDataController@save',
    ];
}
