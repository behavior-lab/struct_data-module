<?php namespace BehaviorLab\StructDataModule\Area;

use BehaviorLab\StructDataModule\Area\Contract\AreaInterface;
use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumCollection;
use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumModel;
use Anomaly\Streams\Platform\Model\StructData\StructDataAreasEntryModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class AreaModel
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class AreaModel extends StructDataAreasEntryModel implements AreaInterface
{

    /**
     * The cascading relations.
     *
     * @var array
     */
    protected $cascades = [
        'structured_data',
    ];

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the related structured_data.
     *
     * @return StructuredDatumCollection
     */
    public function getStructuredData()
    {
        return $this->getAttribute('structured_data');
    }

    /**
     * Return the structured_data relation.
     *
     * @return MorphMany
     */
    public function structured_data()
    {
        return $this
            ->morphMany(StructuredDatumModel::class, 'area', 'area_type');
    }
}
