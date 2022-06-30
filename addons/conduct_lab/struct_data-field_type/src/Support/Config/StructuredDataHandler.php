<?php namespace ConductLab\StructDataFieldType\Support\Config;

use ConductLab\StructDataModule\Installed\InstalledModel;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use ConductLab\ThemesModule\StructuredDatum\StructuredDatumModel;

/**
 * Class StructuredDataHandler
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDataHandler
{
    /**
     * Handle the options.
     *
     * @param CheckboxesFieldType $fieldType
     * @param ExtensionCollection $extensions
     */
    public function handle(CheckboxesFieldType $fieldType, ExtensionCollection $extensions)
    {
        $options = [];

        /* @var StructuredDatumExtension $extension */
        foreach ($extensions->search('conduct_lab.module.structured_data::structured_datum.*')->enabled() as $extension) {
            $options[$extension->getNamespace()] = $extension->getTitle();
        }

        ksort($options);

        $fieldType->setOptions($options);
    }
}
