<?php namespace ConductLab\StructDataFieldType\StructuredDatum;

use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Support\Presenter;

/**
 * Class StructuredDataPresenter
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDataPresenter extends Presenter
{

    /**
     * The decorated object.
     *
     * @var StructuredDataModel
     */
    protected $object;

    /**
     * Return the type of structured_data.
     *
     * @return string
     */
    public function type()
    {
        return $this->object
            ->getEntry()
            ->getStreamSlug();
    }

    /**
     * Return the decorated entry.
     *
     * @return EntryPresenter
     */
    public function entry()
    {
        return (new Decorator())->decorate($this->object->entry);
    }

    /**
     * Catch calls to fields on
     * the page's related entry.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        $entry = $this->object->getEntry();

        if ($entry && $entry->hasField($key)) {
            return (New Decorator())->decorate($entry)->{$key};
        }

        return parent::__get($key);
    }
}
