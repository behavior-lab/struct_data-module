<?php namespace BehaviorLab\StructDataModule\StructuredDatum\Command;

use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenderStructuredDatum
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class RenderStructuredDatum
{

    use DispatchesJobs;

    /**
     * The structured_datum instance.
     *
     * @var StructuredDatumInterface
     */
    protected $structured_datum;

    /**
     * Additional view payload.
     *
     * @var array
     */
    protected $payload;

    /**
     * Create a new RenderStructuredDatum instance.
     *
     * @param StructuredDatumInterface $structured_datum
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
     * @return null|string
     */
    public function handle(Factory $view)
    {
        /* @var StructuredDatumExtension $extension */
        $extension = $this->structured_datum->extension();

        if (!$extension->getView()) {
            return null;
        }

        return $view->make(
            $extension->getWrapper(),
            array_merge(
                [
                    'structured_datum'   => $this->structured_datum,
                    'content' => $this->structured_datum->getContent(),
                ],
                $this->payload
            )
        )->render();
    }
}
