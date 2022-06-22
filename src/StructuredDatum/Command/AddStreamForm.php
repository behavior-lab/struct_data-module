<?php namespace BehaviorLab\StructDataModule\StructuredDatum\Command;

use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use BehaviorLab\StructDataModule\StructuredDatum\Form\StructuredDatumInstanceFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class AddStreamForm
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class AddStreamForm
{

    /**
     * The structured_datum form builder.
     *
     * @var StructuredDatumInstanceFormBuilder
     */
    protected $builder;

    /**
     * The structured_datum extension.
     *
     * @var StructuredDatumExtension
     */
    protected $extension;

    /**
     * Create a new GetStructuredDatumStream instance.
     *
     * @param StructuredDatumInstanceFormBuilder $builder
     * @param StructuredDatumExtension           $extension
     */
    public function __construct(StructuredDatumInstanceFormBuilder $builder, StructuredDatumExtension $extension)
    {
        $this->builder   = $builder;
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @param Container $container
     */
    public function handle(Container $container)
    {
        if (!$stream = $this->extension->stream()) {
            return;
        }

        /* @var FormBuilder $form */
        $form = $container->make($this->extension->getForm());

        $form->setOption('locking_enabled', false);
        $form->setModel($this->extension->getModel());
        $form->setEntry($this->extension->getStructuredDatumEntryId());

        $this->builder->addForm('entry', $form, 0);
    }
}
