<?php namespace ConductLab\StructDataModule\Type\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class TypeFormBuilder
 *
 * @link          https://ConductLab.site/
 * @author        Behavior CPH, ApS <support@ConductLab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        '*',
        'slug' => [
            'disabled' => 'edit',
        ],
    ];
}
