<?php namespace BehaviorLab\StructDataModule\Type\Command;

use BehaviorLab\StructDataModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class DeleteStream
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteStream
{

    /**
     * The structured_datum type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new DeleteStream instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        if (!$this->type->isForceDeleting()) {
            return;
        }

        $streams->delete($streams->findBySlugAndNamespace($this->type->getSlug() . '_structured_data', 'struct_data'));
    }
}
