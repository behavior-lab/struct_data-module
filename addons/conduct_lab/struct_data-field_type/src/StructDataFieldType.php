<?php namespace ConductLab\StructDataFieldType;

use ConductLab\StructDataFieldType\Command\GetMultiformFromPost;
use ConductLab\StructDataFieldType\Command\GetMultiformFromValue;
use ConductLab\StructDataFieldType\Validation\ValidateStructuredData;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumCollection;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumModel;
use ConductLab\StructDataModule\StructuredDatum\Contract\StructuredDatumRepositoryInterface;
use ConductLab\StructDataModule\StructuredDatum\Form\StructuredDatumFormBuilder;
use ConductLab\StructDataModule\StructuredDatum\Form\StructuredDatumInstanceFormBuilder;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class StructDataFieldType
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructDataFieldType extends FieldType
{

    /**
     * The input class.
     *
     * @var string
     */
    protected $class = 'structured_data-container';

    /**
     * No database column.
     *
     * @var bool
     */
    protected $columnType = false;

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'conduct_lab.field_type.struct_data::input';

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'conduct_lab.field_type.struct_data::filter';

    /**
     * The field rules.
     *
     * @var array
     */
    protected $rules = [
        'array',
        'structured_data',
    ];

    /**
     * The field validators.
     *
     * @var array
     */
    protected $validators = [
        'structured_data' => [
            'message' => false,
            'handler' => ValidateStructuredData::class,
        ],
    ];

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new StructDataFieldType instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Return the field ID.
     *
     * @return int
     */
    public function id()
    {
        return $this->entry->getField($this->getField())->getId();
    }

    /**
     * Get the relation.
     *
     * @return MorphMany
     */
    public function getRelation()
    {
        $entry = $this->getEntry();
        $field = $entry->getField($this->getField());

        return $entry
            ->morphMany(StructuredDatumModel::class, 'area', 'area_type')
            ->where('field_id', $field->getId());
    }

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        $rules = parent::getRules();

        if ($min = array_get($this->getConfig(), 'min')) {
            $rules[] = 'min:' . $min;
        }

        if ($max = array_get($this->getConfig(), 'max')) {
            $rules[] = 'max:' . $max;
        }

        return $rules;
    }

    /**
     * Return the input value.
     *
     * @param null $default
     * @return null|MultipleFormBuilder
     */
    public function getInputValue($default = null)
    {
        return $this->dispatch(new GetMultiformFromPost($this));
    }

    /**
     * Return if any posted input is present.
     *
     * @return boolean
     */
    public function hasPostedInput()
    {
        return true;
    }

    /**
     * Get the validation value.
     *
     * @param null $default
     * @return array
     */
    public function getValidationValue($default = null)
    {
        if (!$forms = $this->getInputValue($default)) {
            return [];
        }

        return $forms->getForms()->map(
            function ($builder) {

                /* @var FormBuilder $builder */
                return $builder->getFormEntryId();
            }
        )->all();
    }

    /**
     * Return a form builder instance.
     *
     * @param FieldInterface $field
     * @param StructuredDatumExtension $extension
     * @param null $instance
     * @return MultipleFormBuilder
     */
    public function form(FieldInterface $field, StructuredDatumExtension $extension, $instance = null)
    {

        /* @var StructuredDatumInstanceFormBuilder $form */
        /* @var StructuredDatumFormBuilder $structured_datum */
        $form  = app(StructuredDatumInstanceFormBuilder::class);
        $structured_datum = app(StructuredDatumFormBuilder::class);

        $form->setOption(
            'prefix',
            $this->getFieldName() . '_' . $instance . '_'
        );

        $structured_datum
            ->setExtension($extension)
            ->setOption('locking_enabled', false)
            ->setOption('success_message', false);

        $form->on(
            'saving_structured_datum',
            function () use ($form, $structured_datum) {
                if ($entry = $form->getChildFormEntry('entry')) {
                    $structured_datum->setFormEntryAttribute(
                        'entry',
                        $entry
                    );
                }
            }
        );

        $form->addForm('structured_datum', $structured_datum);

        $extension->extend($form);

        $form
            ->setOption('locking_enabled', false)
            ->setOption('success_message', false)
            ->setOption('structured_datum_instance', $instance)
            ->setOption('structured_datum_field', $field->getId())
            ->setOption('structured_datum_prefix', $this->getFieldName())
            ->setOption('structured_datum_title', $extension->getTitle())
            ->setOption('structured_datum_extension', $extension->getNamespace())
            ->setOption('form_view', 'conduct_lab.field_type.struct_data::form')
            ->setOption('wrapper_view', 'conduct_lab.field_type.struct_data::wrapper');

        $extension->fire('extending', ['builder' => $form, 'field' => $field]);

        return $form;
    }

    /**
     * Return an array of entry forms.
     *
     * @return array
     */
    public function forms()
    {
        if (!$forms = $this->dispatch(new GetMultiformFromValue($this))) {
            return [];
        }

        return array_map(
            function (FormBuilder $form) {
                return $form
                    ->make()
                    ->getForm();
            },
            $forms->getForms()->all()
        );
    }

    /**
     * Handle saving the form data ourselves.
     *
     * @param FormBuilder $builder
     * @param StructuredDatumRepositoryInterface $structured_data
     */
    public function handle(FormBuilder $builder, StructuredDatumRepositoryInterface $structured_data)
    {
        $entry = $builder->getFormEntry();

        /**
         * If we don't have any forms then
         * there isn't much we can do.
         */
        if (!$forms = $this->getInputValue()) {

            $entry->{$this->getField()} = null;

            return;
        }

        /* @var EntryInterface $entry */
        $entry = $this->getEntry();

        /* @var FieldInterface $field */
        $field = $entry->getField($this->getField());

        /* @var StructuredDatumInstanceFormBuilder $form */
        foreach ($forms->getForms()->values() as $key => $form) {

            /* @var StructuredDatumFormBuilder $structured_datum */
            $structured_datum = $form->getChildForm('structured_datum');

            $structured_datum->setArea($entry);
            $structured_datum->setField($field);

            $structured_datum->on(
                'saving',
                function () use ($structured_datum, $key) {
                    $structured_datum->setFormEntryAttribute('sort_order', $key + 1);
                }
            );
        }

        /*
         * Handle the post action
         * for all the child forms.
         */
        $forms->handle();

        $structured_data->sync(
            $entry,
            $field,
            $forms->getForms()->map(
                function (StructuredDatumInstanceFormBuilder $form) {
                    return $form->getChildFormEntryId('structured_datum');
                }
            )->values()->all()
        );
    }

    /**
     * Fired just before version comparison.
     *
     * @param EntryInterface|EloquentModel $entry
     */
    public function onVersioning(EntryInterface $entry)
    {
        $entry
            ->unsetRelation(camel_case($this->getField()))
            ->load(camel_case($this->getField()));
    }

    /**
     * Fired just before version comparison.
     *
     * @param StructuredDatumCollection $related
     * @return array
     */
    public function toArrayForComparison(StructuredDatumCollection $related)
    {
        return $related->map(
            function (StructuredDatumModel $model) {

                $array = array_diff_key(
                    $model->toArrayWithRelations(),
                    array_flip(
                        [
                            'id',
                            'sort_order',
                            'created_at',
                            'created_by_id',
                            'updated_at',
                            'updated_by_id',
                            'deleted_at',
                            'deleted_by_id',

                            'field',
                            'pivot',
                            'area',
                        ]
                    ));

                array_pull($array, 'entry.sort_order');
                array_pull($array, 'entry.created_at');
                array_pull($array, 'entry.created_by_id');
                array_pull($array, 'entry.updated_at');
                array_pull($array, 'entry.updated_by_id');

                return $array;
            }
        )->toArray();
    }
}
