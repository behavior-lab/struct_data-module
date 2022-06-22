<?php namespace BehaviorLab\StructDataModule\Type\Command;

use BehaviorLab\StructDataModule\Type\Contract\TypeInterface;
use BehaviorLab\StructDataModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateStream
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdateStream
{

    use DispatchesJobs;

    /**
     * The structured_datum type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Update a new UpdateStream instance.
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
     * @param TypeRepositoryInterface   $types
     * @param Repository                $config
     */
    public function handle(StreamRepositoryInterface $streams, TypeRepositoryInterface $types, Repository $config)
    {
        /* @var TypeInterface $type */
        if (!$type = $types->find($this->type->getId())) {
            return;
        }

        /* @var StreamInterface $stream */
        $stream = $type->getEntryStream();

        $stream->fill(
            [
                $config->get('app.fallback_locale') => [
                    'name'        => $this->type->getName(),
                    'description' => $this->type->getDescription(),
                ],
                'slug' => $this->type->getSlug() . '_structured_data',
            ]
        );

        $streams->save($stream);
    }
}
