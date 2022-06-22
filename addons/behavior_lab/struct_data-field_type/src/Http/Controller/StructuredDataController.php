<?php namespace BehaviorLab\StructDataFieldType\Http\Controller;

use Anomaly\Streams\Platform\Addon\Addon;
use BehaviorLab\StructDataFieldType\StructDataFieldType;
use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class StructuredDataController
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDataController extends PublicController
{

    /**
     * Choose what kind of row to add.
     *
     * @param FieldRepositoryInterface $fields
     * @param                          $field
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(FieldRepositoryInterface $fields, ExtensionCollection $extensions, $field)
    {
        /* @var FieldInterface $field */
        $field = $fields->find($field);

        /* @var StructDataFieldType $type */
        $type = $field->getType();

        /* @var ExtensionCollection $extensions */
        $extensions = $extensions->search('behavior_lab.module.struct_data::type.*')
            ->enabled()
            ->sort(function ($a, $b) {
                /* @var Addon $a */
                /* @var Addon $b */
                if (trans($a->title) == trans($b->title)) {
                    return 0;
                }

                return (trans($a->title) < trans($b->title)) ? -1 : 1;
            });

        $allowed = $type->config('structured_data', []);

        if (!$allowed) {
            $allowed = array_map(
                function (StructuredDatumExtension $extension) {
                    return $extension->getNamespace();
                },
                $extensions->all()
            );
        }

        $extensions = $extensions->filter(
            function ($extension) use ($allowed) {

                /* @var StructuredDatumExtension $extension */
                return in_array($extension->getNamespace(), $allowed);
            }
        );
//dd($extensions);
        return $this->view->make(
            'behavior_lab.field_type.struct_data::choose',
            [
                'structured_data' => $extensions->all(),
            ]
        );
    }

    /**
     * Return a form row.
     *
     * @param FieldRepositoryInterface $fields
     * @param ExtensionCollection $extensions
     * @param $field
     * @param $extension
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function form(
        FieldRepositoryInterface $fields,
        ExtensionCollection $extensions,
        $field,
        $extension
    ) {

        /* @var FieldInterface $field */
        /* @var StructuredDatumExtension $extension */
        $field     = $fields->find($field);
        $extension = $extensions->get($extension);

        /* @var StructDataFieldType $type */
        $type = $field->getType();

        $type->setPrefix($this->request->get('prefix'));

        return $type
            ->form(
                $field,
                $extension,
                $this->request->get('instance')
            )
            ->addFormData('field_type', $type)
            ->render();
    }
}
