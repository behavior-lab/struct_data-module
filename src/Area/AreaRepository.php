<?php namespace ConductLab\StructDataModule\Area;

use ConductLab\StructDataModule\Area\Contract\AreaInterface;
use ConductLab\StructDataModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class AreaRepository extends EntryRepository implements AreaRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var AreaModel
     */
    protected $model;

    /**
     * Create a new AreaRepository instance.
     *
     * @param AreaModel $model
     */
    public function __construct(AreaModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find an area by it's slug.
     *
     * @param $slug
     * @return AreaInterface|null
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
