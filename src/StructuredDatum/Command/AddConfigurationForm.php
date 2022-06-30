<?php namespace ConductLab\StructDataModule\StructuredDatum\Command;

use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\StructuredDatum\Form\StructuredDatumInstanceFormBuilder;
use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Illuminate\Contracts\Config\Repository;

/**
 * Class AddConfigurationForm
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class AddConfigurationForm
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
     * @param ConfigurationFormBuilder $configuration
     * @param Repository               $config
     */
    public function handle(ConfigurationFormBuilder $configuration, Repository $config)
    {
        if (!$config->get($this->extension->getNamespace('configuration'))) {
            return;
        }

        $configuration->setOption('locking_enabled', false);
        $configuration->setEntry($this->extension->getNamespace());

        if ($structured_datum = $this->builder->getChildEntry('structured_datum')) {
            $configuration->setScope($structured_datum->getId());
        }

        $this->builder->addForm('configuration', $configuration);

        $this->builder->on(
            'saved_structured_datum',
            function () use ($configuration) {
                $configuration->setScope(
                    $this->builder->getChildFormEntryId('structured_datum')
                );
            }
        );
    }
}
