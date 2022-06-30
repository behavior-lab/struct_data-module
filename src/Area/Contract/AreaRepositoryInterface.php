<?php namespace ConductLab\StructDataModule\Area\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface AreaRepositoryInterface
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
interface AreaRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find an area by it's slug.
     *
     * @param $slug
     * @return AreaInterface|null
     */
    public function findBySlug($slug);

}
