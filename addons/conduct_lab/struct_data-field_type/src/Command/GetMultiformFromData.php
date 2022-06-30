<?php namespace ConductLab\StructDataFieldType\Command;

use ConductLab\StructDataFieldType\StructDataFieldType;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use ConductLab\StructDataModule\StructuredDatum\Contract\StructuredDatumRepositoryInterface;
use ConductLab\StructDataModule\StructuredDatum\Form\StructuredDatumFormBuilder;
use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class GetMultiformFromData
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class GetMultiformFromData
{

    /**
     * The field type instance.
     *
     * @var StructDataFieldType
     */
    protected $fieldType;

    /**
     * Create a new GetMultiformFromData instance.
     *
     * @param StructDataFieldType $fieldType
     */
    public function __construct(StructDataFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Get the multiple form builder from the value.
     *
     * @param ExtensionCollection $extensions
     * @param FieldRepositoryInterface $fields
     * @param StructuredDatumRepositoryInterface $structured_data
     * @param MultipleFormBuilder $forms
     * @return MultipleFormBuilder|null
     */
    public function handle(
        ExtensionCollection $extensions,
        FieldRepositoryInterface $fields,
        StructuredDatumRepositoryInterface $structured_data,
        MultipleFormBuilder $forms
    ) {

        /* @var EntryCollection $value */
        if (!$value = $this->fieldType->getValue()) {
            return null;
        }

        foreach ($value as $item) {

            /* @var FieldInterface $field */
            if (!$field = $fields->find($item['field'])) {
                continue;
            }

            /* @var StructuredDatumExtension $extension */
            if (!$extension = $extensions->get($item['extension'])) {
                continue;
            }

            /* @var StructDataFieldType $type */
            $type = $field->getType();

            $type->setPrefix($this->fieldType->getPrefix());

            $extension->unsetStructuredDatum();

            /* @var StructuredDatumInterface $structured_datum */
            if ($item['structured_datum'] && $structured_datum = $structured_data->findWithoutRelations($item['structured_datum'])) {
                $extension->setStructuredDatum($structured_datum);
            }

            $form = $type->form(
                $field,
                $extension,
                $item['instance']
            );

            /* @var StructuredDatumFormBuilder $structured_datum */
            if ($item['structured_datum'] && $structured_datum = $form->getChildForm('structured_datum')) {
                $structured_datum->setEntry($item['structured_datum']);
            }

            /* @var ConfigurationFormBuilder $configuration */
            if ($configuration = $form->getChildForm('configuration')) {
                $configuration
                    ->setEntry($extension->getNamespace())
                    ->setScope($item['structured_datum']);
            }

            $form
                ->setReadOnly($this->fieldType->isReadOnly())
                ->setOption('structured_datum_id', $item['structured_datum']);

            $forms->addForm($this->fieldType->getFieldName() . '_' . $item['instance'], $form);
        }

        $forms
            ->setOption('locking_enabled', false)
            ->setOption('success_message', false);

        return $forms;
    }
}
