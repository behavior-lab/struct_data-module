<?php namespace ConductLab\StructDataFieldType\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Support\Str;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumModel;
use ConductLab\StructDataFieldType\StructDataFieldType;
use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class StructuredDataController
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDataController extends AdminController
{

    /**
     * Choose what kind of row to add.
     *
     * @param MessageBag $messageBag
     * @param Request $request
     * @param $structured_datum_id
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function save(MessageBag $messageBag, Request $request, $structured_datum_id)
    {
        if (!$structured_datum = StructuredDatumModel::find($structured_datum_id)) {
            return Response::json(null, 404);
        }

        $structured_datumEntry = $structured_datum->getEntry();
        $prefix = $request->get('_prefix') . 'entry_';
        $structured_datumPrefix = $request->get('_prefix') . 'structured_datum_';

        foreach ($request->all() as $fieldKey => $fieldValue) {
            if (in_array($fieldKey, ['_prefix', '_token'])) {
                continue;
            }
            $fieldKey = str_replace($prefix, '', $fieldKey);
            if ($structured_datumEntry->hasField($fieldKey)) {
                $structured_datumEntry->$fieldKey = $fieldValue;
            } elseif (str_replace($structured_datumPrefix, '', $fieldKey) === 'title') {
                $fieldKey = str_replace($structured_datumPrefix, '', $fieldKey);
                $structured_datum->$fieldKey = $fieldValue;
                $structured_datum->save();
            } elseif (Str::substr($fieldKey, -3, 1) === '_') {
                $locale = Str::substr($fieldKey, -2);
                $fieldKey = Str::substr($fieldKey, 0, -3);
                if ($locale === $structured_datumEntry->translate($locale)->locale && $structured_datumEntry->hasField($fieldKey)) {
                    $structured_datumEntry->translate($locale)->$fieldKey = $fieldValue;
                    $structured_datumEntry->translate($locale)->save();
                } elseif (str_replace($structured_datumPrefix, '', $fieldKey) === 'title') {
                    $fieldKey = str_replace($structured_datumPrefix, '', $fieldKey);
                    $structured_datum->translate($locale)->$fieldKey = $fieldValue;
                    $structured_datum->translate($locale)->save();
                }

            }
        }


//        dd($request->all());
//        dd($structured_datumEntry);
//        dd($structured_datum);
//
//        dd($request->all());

        $structured_datumEntry->save();
        $messageBag->success('StructuredDatum ' . $structured_datumEntry->title . ' updated');

        return back();
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
    )
    {

        dd(request());
        /* @var FieldInterface $field */
        /* @var StructuredDatumExtension $extension */
        $field = $fields->find($field);
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
