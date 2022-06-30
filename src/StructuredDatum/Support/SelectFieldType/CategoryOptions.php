<?php namespace ConductLab\StructDataModule\StructuredDatum\Support\SelectFieldType;

use ConductLab\StructDataModule\StructuredDatum\StructuredDatumCategories;
use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class CategoryOptions
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class CategoryOptions
{

    /**
     * Handle the category options.
     *
     * @param SelectFieldType $fieldType
     * @param StructuredDatumCategories $categories
     */
    public function handle(SelectFieldType $fieldType, StructuredDatumCategories $categories)
    {
        $categories = $categories->getCategories();

        array_pull($categories, 'all');

        $fieldType->setOptions(
            array_combine(
                array_keys($categories),
                array_map(
                    function ($category) {
                        return $category['name'];
                    },
                    $categories
                )
            )
        );
    }

}
