<?php namespace BehaviorLab\StructDataModule\Type\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface TypeRepositoryInterface
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface TypeRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a type by it's slug.
     *
     * @param $slug
     * @return TypeInterface
     */
    public function findBySlug($slug);
}
