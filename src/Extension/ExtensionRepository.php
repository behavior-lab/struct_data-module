<?php namespace BehaviorLab\StructDataModule\Extension;

use BehaviorLab\StructDataModule\Extension\Contract\ExtensionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ExtensionRepository extends EntryRepository implements ExtensionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ExtensionModel
     */
    protected $model;

    /**
     * Create a new ExtensionRepository instance.
     *
     * @param ExtensionModel $model
     */
    public function __construct(ExtensionModel $model)
    {
        $this->model = $model;
    }
}
