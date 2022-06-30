<?php namespace ConductLab\StructDataModule\StructuredDatum;

use ConductLab\StructDataModule\StructuredDatum\Command\AddConfigurationForm;
use ConductLab\StructDataModule\StructuredDatum\Command\AddStreamForm;
use ConductLab\StructDataModule\StructuredDatum\Command\ExtendFormStructuredData;
use ConductLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use ConductLab\StructDataModule\StructuredDatum\Form\StructuredDatumInstanceFormBuilder;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class StructuredDatumExtension
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDatumExtension extends Extension
{

    /**
     * The structured_datum instance.
     *
     * @var null|StructuredDatumInterface
     */
    protected $structured_datum;

    /**
     * The structured_datum model.
     *
     * @var null|string
     */
    protected $model = null;

    /**
     * The structured_datum settings model.
     *
     * @var null|string
     */
    protected $settings = null;

    /**
     * The structured_datum category.
     *
     * @var null|string
     */
    protected $category = null;

    /**
     * The structured_datum form builder.
     *
     * @var string
     */
    protected $form = FormBuilder::class;

    /**
     * The structured_datum view.
     *
     * @var null|string
     */
    protected $view = 'conduct_lab.module.struct_data::structured_data/content';

    /**
     * The structured_datum wrapper.
     *
     * @var null|string
     */
    protected $wrapper = 'conduct_lab.module.struct_data::structured_data/wrapper';

    /**
     * The text elements that the structured_datum uses.
     *
     * @var array
     */
    protected $textElements = [];

    /**
     * Extend the form builder.
     *
     * @param StructuredDatumInstanceFormBuilder $builder
     */
    public function extend(StructuredDatumInstanceFormBuilder $builder)
    {
        $this->dispatch(new AddStreamForm($builder, $this));
        $this->dispatch(new AddConfigurationForm($builder, $this));

        $this->dispatch(new ExtendFormStructuredData($builder, $this));
    }

    /**
     * Return the structured_datum's entry stream.
     *
     * @return null|StreamInterface
     */
    public function stream()
    {
        if (!$model = $this->getModel()) {
            return null;
        }

        /* @var EntryInterface $model */
        $model = app($model);

        return $model->getStream();
    }

    /**
     * Get the structured_datum.
     *
     * @return null|StructuredDatumInterface
     */
    public function getStructuredDatum()
    {
        return $this->structured_datum;
    }

    /**
     * Get the structured_datum's entry ID.
     *
     * @return int|null
     */
    public function getStructuredDatumEntryId()
    {
        if (!$structured_datum = $this->getStructuredDatum()) {
            return null;
        }

        return $structured_datum->getEntryId();
    }

    /**
     * Set the structured_datum.
     *
     * @param StructuredDatumInterface $structured_datum
     * @return $this
     */
    public function setStructuredDatum(StructuredDatumInterface $structured_datum)
    {
        $this->structured_datum = $structured_datum;

        return $this;
    }

    /**
     * Unset the structured_datum.
     *
     * @return $this
     */
    public function unsetStructuredDatum()
    {
        $this->structured_datum = null;

        return $this;
    }

    /**
     * Get the model.
     *
     * @return null|string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the model.
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the settings model.
     *
     * @return null|string
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set the settings model.
     *
     * @param $settings
     * @return $this
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get the form.
     *
     * @return null|string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set the form.
     *
     * @param $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get the view.
     *
     * @return null|string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the view.
     *
     * @param $view
     * @return $this
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the wrapper.
     *
     * @return null|string
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * Set the wrapper.
     *
     * @param $wrapper
     * @return $this
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    /**
     * Get the category.
     *
     * @return null|string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the category.
     *
     * @param $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the text elements that the structured_datum uses.
     *
     * @return array
     */
    public function getTextElements()
    {
        return $this->textElements;
    }

    /**
     * Set the text elements that the structured_datum uses.
     *
     * @param array $textElements
     * @return $this
     */
    public function setTextElement(array $textElements)
    {
        $this->textElements = $textElements;

        return $this;
    }

}
