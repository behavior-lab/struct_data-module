<?php namespace ConductLab\StructDataModule\Http\Controller\Admin;

use ConductLab\StructDataModule\Extension\Form\ExtensionFormBuilder;
use ConductLab\StructDataModule\Extension\Table\ExtensionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ExtensionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ExtensionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ExtensionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ExtensionFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ExtensionFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ExtensionFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ExtensionFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
