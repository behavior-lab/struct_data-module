<?php namespace BehaviorLab\StructDataModule\Type;

use BehaviorLab\StructDataModule\Type\Contract\TypeRepositoryInterface;
use BehaviorLab\StructDataModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class TypeRepository
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeRepository extends EntryRepository implements TypeRepositoryInterface
{

    /**
     * The structured_datum type model.
     *
     * @var TypeModel
     */
    protected $model;

    /**
     * Create a new TypeRepository instance.
     *
     * @param TypeModel $model
     */
    public function __construct(TypeModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a type by it's slug.
     *
     * @param $slug
     * @return TypeInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
