<?php namespace ConductLab\StructDataModule;

use ConductLab\StructDataModule\Area\Command\GetArea;
use ConductLab\StructDataModule\Area\Contract\AreaInterface;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class StructDataModulePlugin
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructDataModulePlugin extends Plugin
{

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'structured_data',
                function ($identifier) {

                    /* @var AreaInterface $area */
                    if (!$area = $this->dispatch(new GetArea($identifier))) {
                        return null;
                    }

                    return $area->getStructuredData();
                }, ['is_safe' => ['html']]
            ),
        ];
    }
}
