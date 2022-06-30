<?php namespace ConductLab\StructDataModule\StructuredDatum\Command;

use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\StructuredDatum\Form\StructuredDatumInstanceFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ExtendFormStructuredData
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class ExtendFormStructuredData
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
     * @param Repository $config
     */
    public function handle(Repository $config)
    {
        $structured_data = $config->get($this->extension->getNamespace('struct_data'));

        if (!$structured_data) {

            $last = $this->builder
                ->getForms()
                ->last();

            $last->on(
                'built',
                function () {

                    $fields = ['structured_datum_title', 'structured_datum_display_title'];
//                    $fields = [];

                    /* @var FormBuilder $builder */
                    foreach ($this->builder->getForms() as $key => $builder) {
                        $fields = array_unique(
                            array_merge(
                                $fields,
                                $builder->getFormFieldSlugs($key . '_')
                            )
                        );
                    }

                    $this->builder->setSections(
                        [
                            'default' => [
                                'fields' => $fields,
                            ],
                        ]
                    );

                    $this->builder->addButton('save', [
                        'href' => url('/') . '/admin/struct_data/save/{entry.id}'
                    ]);
                    $this->builder->addAction('save');

                    $this->builder->prefixSectionFields($this->builder->getOption('prefix'));
                }
            );

            return;
        }

        $this->builder->setSections(
            [
                'structured_datum' => [
                    'fields' => [
//                        'structured_datum_title',
//                        'structured_datum_display_title',
                    ],
                ],
            ]
        );

        $this->builder->setSections($structured_data);

        $this->builder->prefixSectionFields($this->builder->getOption('prefix'));
    }

}
