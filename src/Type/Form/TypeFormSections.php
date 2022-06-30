<?php namespace ConductLab\StructDataModule\Type\Form;

/**
 * Class TypeFormStructuredData
 *
 * @link          https://ConductLab.site/
 * @author        Behavior CPH, ApS <support@ConductLab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeFormStructuredData
{

    /**
     * Handle the form structured_data.
     *
     * @param TypeFormBuilder $builder
     */
    public function handle(TypeFormBuilder $builder)
    {
        $builder->setStructuredData(
            [
                'type' => [
                    'tabs' => [
                        'general' => [
                            'title'  => 'conduct_lab.module.struct_data::tab.general',
                            'fields' => [
                                'name',
                                'slug',
                                'description',
                                'category',
                            ],
                        ],
                        'content' => [
                            'title'  => 'conduct_lab.module.struct_data::tab.content',
                            'fields' => [
                                'content_layout',
                            ],
                        ],
                        'wrapper' => [
                            'title'  => 'conduct_lab.module.struct_data::tab.wrapper',
                            'fields' => [
                                'wrapper_layout',
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
}
