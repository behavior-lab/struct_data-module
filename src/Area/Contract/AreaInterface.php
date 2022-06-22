<?php namespace BehaviorLab\StructDataModule\Area\Contract;

use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Interface AreaInterface
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
interface AreaInterface extends EntryInterface
{

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related structured_data.
     *
     * @return StructuredDatumCollection
     */
    public function getStructuredData();

    /**
     * Return the structured_data relation.
     *
     * @return MorphMany
     */
    public function structured_data();

}
