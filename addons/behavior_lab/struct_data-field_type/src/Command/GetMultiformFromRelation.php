<?php namespace BehaviorLab\StructDataFieldType\Command;

use BehaviorLab\StructDataFieldType\StructDataFieldType;
use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class GetMultiformFromRelation
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class GetMultiformFromRelation
{

    /**
     * The field type instance.
     *
     * @var StructDataFieldType
     */
    protected $fieldType;

    /**
     * Create a new GetMultiformFromRelation instance.
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
     * @param FieldRepositoryInterface $fields
     * @param MultipleFormBuilder $forms
     * @param Decorator $decorator
     * @return MultipleFormBuilder|null
     */
    public function handle(FieldRepositoryInterface $fields, MultipleFormBuilder $forms, Decorator $decorator)
    {
        /* @var EntryCollection $value */
        if (!$value = $decorator->undecorate($this->fieldType->getValue())) {
            return null;
        }

        $decorator = new Decorator();

        /* @var StructuredDatumInterface $entry */
        foreach ($value as $instance => $entry) {

            $entry     = $decorator->undecorate($entry);
            $extension = $decorator->undecorate($entry->extension());

            /* @var FieldInterface $field */
            if (!$field = $fields->find($this->fieldType->id())) {
                continue;
            }

            /* @var StructDataFieldType $type */
            $type = $field->getType();

            $type->setPrefix($this->fieldType->getPrefix());

            $extension->setStructuredDatum($entry);

            $form = $type->form(
                $field,
                $extension,
                $instance
            );

            if ($structured_datum = $form->getChildForm('structured_datum')) {
                $structured_datum->setEntry($entry);
            }

            /* @var ConfigurationFormBuilder $configuration */
            if ($configuration = $form->getChildForm('configuration')) {
                $configuration
                    ->setEntry($extension->getNamespace())
                    ->setScope($entry->getId());
            }

            if ($form->hasChildForm('entry')) {
                $form->setChildFormEntry('entry', $entry->getEntry());
            }

            $form
                ->setReadOnly($this->fieldType->isReadOnly())
                ->setOption('structured_datum_id', $entry->getId())
                ->setOption('structured_datum_subtitle', $entry->getTitle());

            $forms->addForm($this->fieldType->getFieldName() . '_' . $instance, $form);
        }

        $forms
            ->setOption('locking_enabled', false)
            ->setOption('success_message', false);

        return $forms;
    }
}
