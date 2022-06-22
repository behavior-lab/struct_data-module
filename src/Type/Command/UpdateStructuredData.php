<?php namespace BehaviorLab\StructDataModule\Type\Command;

use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumRepositoryInterface;
use BehaviorLab\StructDataModule\Type\Contract\TypeInterface;
use BehaviorLab\StructDataModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateStructuredData
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdateStructuredData
{

    use DispatchesJobs;

    /**
     * The structured_datum type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Update a new UpdateStructuredData instance.
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
     * @param TypeRepositoryInterface $types
     * @param StructuredDatumRepositoryInterface $structured_data
     */
    public function handle(TypeRepositoryInterface $types, StructuredDatumRepositoryInterface $structured_data)
    {
        /* @var TypeInterface $type */
        if (!$type = $types->find($this->type->getId())) {
            return;
        }

        /* @var StructuredDatumInterface $structured_datum */
        foreach ($type->getStructuredData() as $structured_datum) {
            $structured_data->save($structured_datum->setAttribute('entry_type', $this->type->getEntryModelName()));
        }
    }
}
