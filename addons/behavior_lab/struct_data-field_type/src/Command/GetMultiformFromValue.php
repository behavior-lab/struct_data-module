<?php namespace BehaviorLab\StructDataFieldType\Command;

use BehaviorLab\StructDataFieldType\StructDataFieldType;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;

/**
 * Class GetMultiformFromValue
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class GetMultiformFromValue
{

    use DispatchesJobs;

    /**
     * The field type instance.
     *
     * @var StructDataFieldType
     */
    protected $fieldType;

    /**
     * Create a new GetMultiformFromValue instance.
     *
     * @param StructDataFieldType $fieldType
     */
    public function __construct(StructDataFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Get the multiple form builder from the value.
     *
     * @return MultipleFormBuilder|null
     */
    public function handle()
    {
        /* @var EntryCollection $value */
        if (!$value = $this->fieldType->getValue()) {
            return null;
        }

        if (is_array($value)) {
            return $this->dispatch(new GetMultiformFromData($this->fieldType));
        }

        if ($value instanceof Collection) {
            return $this->dispatch(new GetMultiformFromRelation($this->fieldType));
        }

        return null;
    }
}
