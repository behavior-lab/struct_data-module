<?php namespace ConductLab\StructDataModule\StructuredDatum\Command;

use ConductLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use ConductLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class MakeStructuredDatum
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class MakeStructuredDatum
{

    use DispatchesJobs;

    /**
     * The structured_datum instance.
     *
     * @var StructuredDatumInterface
     */
    protected $structured_datum;

    /**
     * The structured_datum payload.
     *
     * @var array
     */
    protected $payload;

    /**
     * Create a new MakeStructuredDatum instance.
     *
     * @param StructuredDatumInterface $structured_datum
     * @param array $payload
     */
    public function __construct(StructuredDatumInterface $structured_datum, array $payload = [])
    {
        $this->structured_datum   = $structured_datum;
        $this->payload = $payload;
    }

    /**
     * Handle the command.
     *
     * @param Factory $view
     */
    public function handle(Factory $view)
    {
        /* @var StructuredDatumExtension $extension */
        $extension = $this->structured_datum->extension();

        $extension->fire(
            'load',
            [
                'structured_datum' => $this->structured_datum,
            ]
        );

        if (!$extension->getView()) {
            return;
        }

        $this->structured_datum->setContent(
            $view
                ->make(
                    $extension->getView(),
                    array_merge(['structured_datum' => $this->structured_datum], $this->payload)
                )
                ->render()
        );
    }
}
