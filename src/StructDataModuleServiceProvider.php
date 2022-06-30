<?php namespace ConductLab\StructDataModule;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use ConductLab\StructDataModule\Extension\Contract\ExtensionRepositoryInterface;
use ConductLab\StructDataModule\Extension\ExtensionRepository;
use Anomaly\Streams\Platform\Model\StructData\StructDataExtensionsEntryModel;
use ConductLab\StructDataModule\Extension\ExtensionModel;
use ConductLab\StructDataModule\Area\AreaModel;
use ConductLab\StructDataModule\Area\AreaRepository;
use ConductLab\StructDataModule\Area\Contract\AreaRepositoryInterface;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumCategories;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumModel;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumRepository;
use ConductLab\StructDataModule\StructuredDatum\Contract\StructuredDatumRepositoryInterface;
use ConductLab\StructDataModule\Http\Controller\Admin\AssignmentsController;
use ConductLab\StructDataModule\Http\Controller\Admin\FieldsController;
use ConductLab\StructDataModule\Type\Command\RegisterStructuredData;
use ConductLab\StructDataModule\Type\Contract\TypeRepositoryInterface;
use ConductLab\StructDataModule\Type\TypeModel;
use ConductLab\StructDataModule\Type\TypeRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Model\StructData\StructDataAreasEntryModel;
use Anomaly\Streams\Platform\Model\StructData\StructDataTypesEntryModel;
use Illuminate\Routing\Router;

/**
 * Class StructDataModuleServiceProvider
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructDataModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        StructDataModulePlugin::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/struct_data/extensions'           => 'ConductLab\StructDataModule\Http\Controller\Admin\ExtensionsController@index',
        'admin/struct_data/extensions/create'    => 'ConductLab\StructDataModule\Http\Controller\Admin\ExtensionsController@create',
        'admin/struct_data/extensions/edit/{id}' => 'ConductLab\StructDataModule\Http\Controller\Admin\ExtensionsController@edit',
//        'admin/struct_data'                        => 'ConductLab\StructDataModule\Http\Controller\Admin\AreasController@index',
//        'admin/struct_data/create'                 => 'ConductLab\StructDataModule\Http\Controller\Admin\AreasController@create',
//        'admin/struct_data/choose'                 => 'ConductLab\StructDataModule\Http\Controller\Admin\AreasController@choose',
//        'admin/struct_data/edit/{id}'              => 'ConductLab\StructDataModule\Http\Controller\Admin\AreasController@edit',
//        'admin/struct_data/types'                  => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@index',
//        'admin/struct_data/types/create'           => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@create',
//        'admin/struct_data/types/edit/{id}'        => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@edit',
        'admin/struct_data'                        => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@index',
        'admin/struct_data/create'                 => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@create',
        'admin/struct_data/edit/{id}'              => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@edit',
        'admin/struct_data/types'                  => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@index',
        'admin/struct_data/types/create'           => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@create',
        'admin/struct_data/types/edit/{id}'        => 'ConductLab\StructDataModule\Http\Controller\Admin\TypesController@edit',
        'admin/struct_data/areas/{area}'           => 'ConductLab\StructDataModule\Http\Controller\Admin\StructuredDataController@index',
        'admin/struct_data/areas/{area}/create'    => 'ConductLab\StructDataModule\Http\Controller\Admin\StructuredDataController@create',
        'admin/struct_data/areas/{area}/choose'    => 'ConductLab\StructDataModule\Http\Controller\Admin\StructuredDataController@choose',
        'admin/struct_data/areas/{area}/edit/{id}' => 'ConductLab\StructDataModule\Http\Controller\Admin\StructuredDataController@edit',
        'admin/struct_data/save/{structured_datum_id}'      => 'ConductLab\StructDataModule\Http\Controller\Admin\StructuredDataController@save',
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        StructDataExtensionsEntryModel::class => ExtensionModel::class,
        StructDataAreasEntryModel::class => AreaModel::class,
        StructDataTypesEntryModel::class => TypeModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        ExtensionRepositoryInterface::class => ExtensionRepository::class,
        StructuredDatumCategories::class          => StructuredDatumCategories::class,
        AreaRepositoryInterface::class  => AreaRepository::class,
        TypeRepositoryInterface::class  => TypeRepository::class,
        StructuredDatumRepositoryInterface::class => StructuredDatumRepository::class,
    ];

    /**
     * Boot the addon.
     */
    public function boot()
    {
        if (class_exists(StructDataTypesEntryModel::class)) {
            $this->dispatch(new RegisterStructuredData());
        }
    }

    /**
     * Register the addon.
     *
     * @param EntryModel $model
     */
    public function register(EntryModel $model)
    {

        /**
         * Register global structured_datum
         * area relation methods.
         */
        $model->bind(
            'struct_data',
            function ($field = 'struct_data') {

                /* @var EntryInterface $this */
                $field = $this->getField($field);

                return $this
                    ->morphMany(StructuredDatumModel::class, 'area', 'area_type')
                    ->where('field_id', $field->getId());
            }
        );

        $model->bind(
            'get_struct_data',
            function ($field = 'struct_data') {

                /* @var EntryInterface $this */
                return $this
                    ->call('struct_data', compact('field'))
                    ->getResults();
            }
        );
    }

    /**
     * Map additional routes.
     *
     * @param FieldRouter $fields
     * @param AssignmentRouter $assignments
     */
    public function map(FieldRouter $fields, AssignmentRouter $assignments)
    {
        $fields->route($this->addon, FieldsController::class);
        $assignments->route($this->addon, AssignmentsController::class, 'admin/struct_data/types');
    }

}
