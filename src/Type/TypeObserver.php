<?php namespace BehaviorLab\StructDataModule\Type;

use BehaviorLab\StructDataModule\Type\Command\CreateStream;
use BehaviorLab\StructDataModule\Type\Command\DeleteStream;
use BehaviorLab\StructDataModule\Type\Command\UpdateStructuredData;
use BehaviorLab\StructDataModule\Type\Command\UpdateStream;
use BehaviorLab\StructDataModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Http\Command\ClearHttpCache;

/**
 * Class TypeObserver
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeObserver extends EntryObserver
{

    /**
     * Fired after a structured_datum type is created.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function created(EntryInterface $entry)
    {
        dispatch_now(new CreateStream($entry));

        parent::created($entry);
    }

    /**
     * Fired before a structured_datum type is updated.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function updating(EntryInterface $entry)
    {
        dispatch_now(new UpdateStream($entry));
        dispatch_now(new UpdateStructuredData($entry));

        parent::updating($entry);
    }

    /**
     * Fired after a structured_datum type is updated.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function updated(EntryInterface $entry)
    {
        dispatch_now(new ClearHttpCache($entry));

        parent::updated($entry);
    }

    /**
     * Fired after a structured_datum type is deleted.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        dispatch_now(new DeleteStream($entry));

        parent::deleted($entry);
    }
}
