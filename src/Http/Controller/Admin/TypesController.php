<?php namespace BehaviorLab\StructDataModule\Http\Controller\Admin;

use BehaviorLab\StructDataModule\Type\Form\TypeFormBuilder;
use BehaviorLab\StructDataModule\Type\Table\TypeTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class TypesController
 *
 * @link          https://behaviorlab.site/
 * @author        Behavior CPH, ApS <support@behaviorlab.site>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypesController extends AdminController
{

    /**
     * Return an index of existing structured_datum types.
     *
     * @param  TypeTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TypeTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a form for a new structured_datum type.
     *
     * @param  TypeFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TypeFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return a form for editing an existing structured_datum type.
     *
     * @param  TypeFormBuilder $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(TypeFormBuilder $form, $id)
    {
        return $form->render($id);
    }

}
