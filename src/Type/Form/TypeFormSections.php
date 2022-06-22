<?php namespace BehaviorLab\StructDataModule\Type\Form;

/**
 * Class TypeFormStructuredData
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
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
                            'title'  => 'behavior_lab.module.struct_data::tab.general',
                            'fields' => [
                                'name',
                                'slug',
                                'description',
                                'category',
                            ],
                        ],
                        'content' => [
                            'title'  => 'behavior_lab.module.struct_data::tab.content',
                            'fields' => [
                                'content_layout',
                            ],
                        ],
                        'wrapper' => [
                            'title'  => 'behavior_lab.module.struct_data::tab.wrapper',
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
