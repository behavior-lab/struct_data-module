<?php namespace ConductLab\StructDataModule\Type\Command;

use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\StructuredDatum\Form\StructuredDatumFormBuilder;
use ConductLab\StructDataModule\Type\Contract\TypeInterface;
use ConductLab\StructDataModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class RegisterStructuredData
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class RegisterStructuredData
{

    /**
     * Handle the command.
     *
     * @param AddonCollection         $addons
     * @param TypeRepositoryInterface $types
     * @param ExtensionCollection     $extensions
     */
    public function handle(
        AddonCollection $addons,
        TypeRepositoryInterface $types,
        ExtensionCollection $extensions
    ) {

        /**
         * Register Custom StructuredDatum Types
         *
         * @var TypeInterface $type
         */
        foreach ($types->all() as $type) {

            $extension = new StructuredDatumExtension();

            $extension
                ->setEnabled(true)
                ->setInstalled(true)
                ->setType('extension')
                ->setVendor('anomaly')
                ->setName($type->getName())
                ->setTitle($type->getName())
                ->setCategory($type->getCategory())
                ->setSlug($type->getSlug() . '_structured_datum')
                ->setModel($type->getEntryModelName())
                ->setView($type->getContentLayoutView())
                ->setDescription($type->getDescription())
                ->setWrapper($type->getWrapperLayoutView())
                ->setPath(realpath(__DIR__ . '/../../../'))
                ->setProvides('conduct_lab.module.struct_data::structured_datum.' . $type->getSlug());

            $extension->on(
                'extending',
                function (MultipleFormBuilder $builder) use ($type) {

                    $builder->setOption('structured_datum_type', $type->getId());

                    /* @var StructuredDatumFormBuilder $structured_datum */
                    $structured_datum = $builder->getChildForm('structured_datum');

                    $structured_datum->setType($type);
                }
            );

            $addons->put($extension->getNamespace(), $extension);
            $extensions->put($extension->getNamespace(), $extension);
        }
    }
}
