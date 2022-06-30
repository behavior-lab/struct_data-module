<?php namespace ConductLab\StructDataModule\Type\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface TypeRepositoryInterface
 *
 * @link          https://ConductLab.site/
 * @author        Behavior CPH, ApS <support@ConductLab.site>
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
