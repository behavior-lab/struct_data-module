<?php namespace ConductLab\StructDataModule\StructuredDatum\Form;

use ConductLab\StructDataModule\Area\Contract\AreaInterface;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class StructuredDatumFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       ConductLab\StructDataModule\StructuredDatum\Form
 */
class StructuredDatumFormBuilder extends FormBuilder
{

    /**
     * The area instance.
     *
     * @var null|AreaInterface
     */
    protected $area = null;

    /**
     * The type instance.
     *
     * @var null|TypeInterface
     */
    protected $type = null;

    /**
     * The structured_datum field.
     *
     * @var null|FieldInterface $field
     */
    protected $field = null;

    /**
     * The structured_datum extension.
     *
     * @var null|StructuredDatumExtension
     */
    protected $extension = null;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'title' => [
            'hidden'     => false,
        ],
//        'display_title' => [
//            'hidden'     => true,
//        ],
    ];

    /**
     * Fired just before
     * saving the form entry.
     */
    public function onSaving()
    {
        if ($area = $this->getArea()) {
            $this->setFormEntryAttribute('area', $area);
        }

        if ($type = $this->getType()) {
            $this->setFormEntryAttribute('type', $type);
        }

        if ($field = $this->getField()) {
            $this->setFormEntryAttribute('field', $field);
        }

        if ($extension = $this->getExtension()) {
            $this->setFormEntryAttribute('extension', $extension);
        }
    }

    /**
     * Get the area.
     *
     * @return EntryInterface|AreaInterface|null
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set the area.
     *
     * @param EntryInterface $area
     * @return $this
     */
    public function setArea(EntryInterface $area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get the type.
     *
     * @return null|TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param TypeInterface $type
     * @return $this
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the field.
     *
     * @return FieldInterface|null
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set the field.
     *
     * @param FieldInterface $field
     * @return $this
     */
    public function setField(FieldInterface $field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get the structured_datum extension.
     *
     * @return StructuredDatumExtension|null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set the structured_datum type.
     *
     * @param StructuredDatumExtension $extension
     * @return $this
     */
    public function setExtension(StructuredDatumExtension $extension)
    {
        $this->extension = $extension;

        return $this;
    }
}
