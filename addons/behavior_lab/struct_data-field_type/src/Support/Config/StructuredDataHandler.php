<?php namespace BehaviorLab\StructDataFieldType\Support\Config;

use BehaviorLab\StructDataModule\Installed\InstalledModel;
use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use BehaviorLab\ThemesModule\StructuredDatum\StructuredDatumModel;

/**
 * Class StructuredDataHandler
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
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
        foreach ($extensions->search('behavior_lab.module.structured_data::structured_datum.*')->enabled() as $extension) {
            $options[$extension->getNamespace()] = $extension->getTitle();
        }

        ksort($options);

        $fieldType->setOptions($options);
    }
}
