<?php namespace ConductLab\StructDataFieldType\Validation;

use ConductLab\StructDataFieldType\Command\GetMultiformFromPost;
use ConductLab\StructDataFieldType\StructDataFieldType;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ValidateStructuredData
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class ValidateStructuredData
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param StructDataFieldType $fieldType
     * @return bool
     */
    public function handle(StructDataFieldType $fieldType)
    {
        /* @var MultipleFormBuilder $forms */
        if (!$forms = $this->dispatch(new GetMultiformFromPost($fieldType))) {
            return true;
        }

        $forms
            ->build()
            ->validate();

        if (!$forms->getFormErrors()->isEmpty()) {
            return false;
        }

        return true;
    }
}
