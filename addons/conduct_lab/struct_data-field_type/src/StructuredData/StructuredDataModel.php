<?php

namespace ConductLab\StructDataFieldType\StructuredDatum;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Robbo\Presenter\PresentableInterface;

/**
 * Class StructuredDataModel
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDataModel extends Model implements PresentableInterface
{
    public $table = 'structured_data_structured_data';

    /**
     * No dates.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Fillable properties.
     *
     * @var array
     */
    protected $fillable = [
        'entry_id',
        'entry_type',
        'related_id',
        'structured_datum_type',
        'sort_order',
    ];

    /**
     * Return the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Return the entry relation.
     *
     * @return MorphTo
     */
    public function entry()
    {
        return $this->morphTo('entry');
    }

    /**
     * Return a created presenter.
     *
     * @return StructuredDataPresenter
     */
    public function getPresenter()
    {
        return new StructuredDataPresenter($this);
    }

    /**
     * Define a polymorphic, inverse one-to-one or many relationship.
     *
     * @param  string $name
     * @param  string $type
     * @param  string $id
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function morphTo($name = null, $type = null, $id = null, $ownerKey = null)
    {
        /**
         * Check that the structured_data relation still
         * exists. If it does NOT then we send
         * a bogus relation back instead.
         */
        if (!class_exists($this->entry_type)) {
            return new MorphTo(
                $this->newQuery(),
                $this,
                -1,
                null,
                $type,
                $name
            );
        }

        return parent::morphTo($name, $type, $id, $ownerKey);
    }
}
