<?php namespace BehaviorLab\StructDataModule\StructuredDatum;

use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumRepositoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;

/**
 * Class StructuredDatumRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       BehaviorLab\StructDataModule\StructuredDatum
 */
class StructuredDatumRepository extends EntryRepository implements StructuredDatumRepositoryInterface
{

    /**
     * The structured_datum model.
     *
     * @var StructuredDatumModel
     */
    protected $model;

    /**
     * Create a new StructuredDatumRepository instance.
     *
     * @param StructuredDatumModel $model
     */
    public function __construct(StructuredDatumModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a structured_datum by it's slug.
     *
     * @param $slug
     * @return null|StructuredDatumInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Sync an area's structured_data.
     *
     * @param EntryInterface $area
     * @param FieldInterface $field
     * @param array          $ids
     */
    public function sync(EntryInterface $area, FieldInterface $field, array $ids)
    {
        $this->model
            ->where('area_type', get_class($area))
            ->where('area_id', $area->getId())
            ->where('field_id', $field->getId())
            ->whereNotIn('id', $ids)
            ->delete();
    }
}
