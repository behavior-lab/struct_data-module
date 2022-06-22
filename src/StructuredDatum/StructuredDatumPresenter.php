<?php namespace BehaviorLab\StructDataModule\StructuredDatum;

use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class StructuredDatumPresenter
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDatumPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     *
     * @var StructuredDatumInterface
     */
    protected $object;

    /**
     * Catch calls to fields on
     * the page's related entry.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (in_array($key, ['id']) || $this->object->hasField($key)) {
            return parent::__get($key);
        }

        if ($this->object->hasData($key)) {
            return $this->object->getData()[$key];
        }

        $entry = $this->object->getEntry();

        if ($entry && $entry->hasField($key)) {
            return (New Decorator())->decorate($entry)->{$key};
        }

        return $this->object->configuration($key);
    }
}
