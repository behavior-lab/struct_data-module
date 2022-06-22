<?php namespace BehaviorLab\StructDataModule\Http\Controller\Admin;

use BehaviorLab\StructDataModule\Area\Contract\AreaRepositoryInterface;
use BehaviorLab\StructDataModule\Area\Form\AreaFormBuilder;
use BehaviorLab\StructDataModule\Area\Table\AreaTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AreasController
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class AreasController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param AreaTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AreaTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param AreaFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(AreaFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return a list of areas to view.
     *
     * @param AreaRepositoryInterface $areas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function choose(AreaRepositoryInterface $areas)
    {
        return $this->view->make(
            'behavior_lab.module.struct_data::admin/areas/choose',
            [
                'areas' => $areas->all(),
            ]
        );
    }

    /**
     * Edit an existing entry.
     *
     * @param AreaFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AreaFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
