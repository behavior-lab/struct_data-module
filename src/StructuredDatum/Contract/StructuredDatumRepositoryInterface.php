<?php namespace BehaviorLab\StructDataModule\StructuredDatum\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;

/**
 * Interface StructuredDatumRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       BehaviorLab\StructDataModule\StructuredDatum\Contract
 */
interface StructuredDatumRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a structured_datum by it's slug.
     *
     * @param $slug
     * @return null|StructuredDatumInterface
     */
    public function findBySlug($slug);

    /**
     * Sync an area's structured_data.
     *
     * @param EntryInterface $area
     * @param FieldInterface $field
     * @param array          $ids
     * @return
     */
    public function sync(EntryInterface $area, FieldInterface $field, array $ids);

}
