<?php namespace ConductLab\StructDataModule\StructuredDatum;

/**
 * Class StructuredDatumCategories
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDatumCategories
{

    /**
     * Available categories.
     *
     * @var array
     */
    protected $categories = [
        'all'         => [
            'name'        => 'conduct_lab.module.struct_data::category.all.name',
            'description' => 'conduct_lab.module.struct_data::category.all.description',
        ],
        'content'     => [
            'name'        => 'conduct_lab.module.struct_data::category.content.name',
            'description' => 'conduct_lab.module.struct_data::category.content.description',
        ],
        'information' => [
            'name'        => 'conduct_lab.module.struct_data::category.information.name',
            'description' => 'conduct_lab.module.struct_data::category.information.description',
        ],
        'component'   => [
            'name'        => 'conduct_lab.module.struct_data::category.component.name',
            'description' => 'conduct_lab.module.struct_data::category.component.description',
        ],
        'media'       => [
            'name'        => 'conduct_lab.module.struct_data::category.media.name',
            'description' => 'conduct_lab.module.struct_data::category.media.description',
        ],
        'addon'       => [
            'name'        => 'conduct_lab.module.struct_data::category.addon.name',
            'description' => 'conduct_lab.module.struct_data::category.addon.description',
        ],
        'social'      => [
            'name'        => 'conduct_lab.module.struct_data::category.social.name',
            'description' => 'conduct_lab.module.struct_data::category.social.description',
        ],
        'layout'      => [
            'name'        => 'conduct_lab.module.structured_data::category.layout.name',
            'description' => 'conduct_lab.module.structured_data::category.layout.description',
        ],
        'other'       => [
            'name'        => 'conduct_lab.module.structured_data::category.other.name',
            'description' => 'conduct_lab.module.structured_data::category.other.description',
        ],
    ];

    /**
     * Register a category.
     *
     * @param $category
     * @param $name
     * @return $this
     */
    public function register($category, $name)
    {
        array_set($this->categories, $category, $name);

        return $this;
    }

    /**
     * Get the categories.
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set the categories.
     *
     * @param array $categories
     * @return $this
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

}
