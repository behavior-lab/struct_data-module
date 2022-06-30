<?php namespace ConductLab\StructDataModule\StructuredDatum\Form;

use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class StructuredDatumInstanceFormBuilder
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDatumInstanceFormBuilder extends MultipleFormBuilder
{

    /**
     * The form structured_data.
     *
     * @var array
     */
    protected $structured_data = [
        'structured_datum' => [
            'fields' => [
                'structured_datum_title',
            ],
        ],
    ];

    /**
     * Return the contextual ID.
     *
     * @return int|null
     */
    public function getContextualId()
    {
        return $this->getChildFormEntryId('structured_datum');
    }
}
