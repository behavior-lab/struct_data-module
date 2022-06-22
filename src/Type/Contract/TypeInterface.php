<?php namespace BehaviorLab\StructDataModule\Type\Contract;

use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumCollection;
use BehaviorLab\StructDataModule\StructuredDatum\Handler\Contract\StructuredDatumHandlerInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Interface TypeInterface
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface TypeInterface extends EntryInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the category.
     *
     * @return string
     */
    public function getCategory();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream();

    /**
     * Get the related entry stream ID.
     *
     * @return int
     */
    public function getEntryStreamId();

    /**
     * Get the related entry model.
     *
     * @return EntryModel
     */
    public function getEntryModel();

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName();

    /**
     * Get content layout view.
     *
     * @return string
     */
    public function getContentLayoutView();

    /**
     * Get wrapper layout view.
     *
     * @return string
     */
    public function getWrapperLayoutView();

    /**
     * Get the related structured_data.
     *
     * @return StructuredDatumCollection
     */
    public function getStructuredData();

    /**
     * Return the structured_data relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function structured_data();
}
