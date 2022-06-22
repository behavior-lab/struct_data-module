<?php namespace BehaviorLab\StructDataModule\Type\Table;

use BehaviorLab\StructDataModule\Type\Contract\TypeInterface;

/**
 * Class TypeTableButtons
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class TypeTableButtons
{

    /**
     * Handle the buttons.
     *
     * @param TypeTableBuilder $builder
     */
    public function handle(TypeTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'edit',
                'assignments' => [
                    'href' => function (TypeInterface $entry) {
                        return '/admin/struct_data/types/assignments/' . $entry->getEntryStreamId();
                    },
                ],
            ]
        );
    }
}
