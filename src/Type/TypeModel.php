<?php namespace BehaviorLab\StructDataModule\Type;

use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumCollection;
use BehaviorLab\StructDataModule\Type\Command\GetStream;
use BehaviorLab\StructDataModule\Type\Contract\TypeInterface;
use Anomaly\EditorFieldType\EditorFieldType;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\StructData\StructDataTypesEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class TypeModel
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeModel extends StructDataTypesEntryModel implements TypeInterface
{

    /**
     * Always eager load these.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'structured_data',
    ];

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream()
    {
        return $this->dispatch(new GetStream($this));
    }

    /**
     * Get the related entry stream ID.
     *
     * @return int
     */
    public function getEntryStreamId()
    {
        if (!$stream = $this->getEntryStream()) {
            return null;
        }

        return $stream->getId();
    }

    /**
     * Get the related entry model.
     *
     * @return EntryModel
     */
    public function getEntryModel()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModel();
    }

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModelName();
    }

    /**
     * Get content layout view.
     *
     * @return string
     */
    public function getContentLayoutView()
    {
        /* @var EditorFieldType $fieldType */
        $fieldType = $this->getFieldType('content_layout');

        return $fieldType->getViewPath();
    }

    /**
     * Get wrapper layout view.
     *
     * @return string
     */
    public function getWrapperLayoutView()
    {
        /* @var EditorFieldType $fieldType */
        $fieldType = $this->getFieldType('wrapper_layout');

        return $fieldType->getViewPath();
    }

    /**
     * Get the related structured_data.
     *
     * @return StructuredDatumCollection
     */
    public function getStructuredData()
    {
        return $this
            ->structured_data()
            ->getResults();
    }

    /**
     * Return the structured_data relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function structured_data()
    {
        return $this->hasMany('BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumModel', 'type_id');
    }
}
