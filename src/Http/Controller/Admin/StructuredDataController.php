<?php namespace BehaviorLab\StructDataModule\Http\Controller\Admin;

use BehaviorLab\StructDataModule\Area\Command\GetArea;
use BehaviorLab\StructDataModule\Area\Contract\AreaInterface;
use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumRepositoryInterface;
use BehaviorLab\StructDataModule\StructuredDatum\Form\StructuredDatumFormBuilder;
use BehaviorLab\StructDataModule\StructuredDatum\Form\StructuredDatumInstanceFormBuilder;
use BehaviorLab\StructDataModule\StructuredDatum\Table\StructuredDatumTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class StructuredDataController
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDataController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param StructuredDatumTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(StructuredDatumTableBuilder $table, $area)
    {

        /* @var AreaInterface $area */
        if (!$area = $this->dispatch(new GetArea($area))) {
            abort(404);
        }

        $table->setArea($area);

        $table->setOption('title', $area->getTitle());
        $table->setOption('description', $area->getDescription());

        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param StructuredDatumInstanceFormBuilder|StructuredDatumFormBuilder $form
     * @param StructuredDatumFormBuilder $default
     * @param ExtensionCollection $extensions
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        StructuredDatumInstanceFormBuilder $form,
        StructuredDatumFormBuilder $structured_datum,
        ExtensionCollection $extensions,
        $area
    ) {

        /* @var StructuredDatumExtension $extension */
        if (!$extension = $extensions->get($this->request->get('extension'))) {
            abort(400, 'You must specify a structured_datum extension.');
        }

        $structured_datum->setExtension($extension);

        /* @var AreaInterface $area */
        if (!$area = $this->dispatch(new GetArea($area))) {
            abort(404);
        }

        $field = $area->getField('structured_data');

        $structured_datum->setArea($area);
        $structured_datum->setField($field);

        $form->setOption('title', $area->getTitle());
        $form->setOption('description', $area->getDescription());

        $form->on(
            'saving_structured_datum',
            function () use ($form, $structured_datum) {
                if ($entry = $form->getChildFormEntry('entry')) {
                    $structured_datum->setFormEntryAttribute(
                        'entry',
                        $entry
                    );
                }
            }
        );

        $form->addForm('structured_datum', $structured_datum);

        $extension->extend($form);

        return $form->render();
    }

    /**
     * Return a list of structured_data to view.
     *
     * @param StructuredDatumRepositoryInterface $structured_data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {

        /* @var ExtensionCollection $extensions */
        $extensions = $extensions
            ->search('behavior_lab.module.struct_data::type.*')
            ->enabled()
            ->sort();

        return $this->view->make(
            'behavior_lab.module.struct_data::admin/structured_data/choose',
            [
                'extensions' => $extensions->all(),
            ]
        );
    }

    /**
     * Edit an existing entry.
     *
     * @param StructuredDatumInstanceFormBuilder $form
     * @param StructuredDatumFormBuilder $structured_datum
     * @param StructuredDatumRepositoryInterface $structured_data
     * @param $area
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        StructuredDatumInstanceFormBuilder $form,
        StructuredDatumFormBuilder $structured_datum,
        StructuredDatumRepositoryInterface $structured_data,
        $area,
        $id
    ) {

        /* @var StructuredDatumInterface $entry */
        if (!$entry = $structured_data->find($id)) {
            abort(404);
        }

        $structured_datum->setEntry($entry);

        /* @var AreaInterface $area */
        $area = $entry->getArea();

        $form->setOption('title', $area->getTitle());
        $form->setOption('description', $area->getDescription());

        /* @var StructuredDatumExtension $extension */
        $extension = $entry->extension();

        $form->addForm('structured_datum', $structured_datum);

        $extension->extend($form);

        return $form->render($id);
    }
}
