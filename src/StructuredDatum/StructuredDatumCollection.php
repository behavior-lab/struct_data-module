<?php namespace BehaviorLab\StructDataModule\StructuredDatum;

use BehaviorLab\StructDataModule\StructuredDatum\Contract\StructuredDatumInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class StructuredDatumCollection
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructuredDatumCollection extends EntryCollection
{

    use DispatchesJobs;

    /**
     * Return if the collection has a
     * structured_datum type or default to key.
     *
     * @param mixed $key
     * @return bool
     */
    public function has($key)
    {
        $item = $this->first(
            function ($structured_datum) use ($key) {

                /* @var StructuredDatumInterface $structured_datum */
                return str_is($key, $structured_datum->getExtensionSlug()) || str_is($key, $structured_datum->getExtensionNamespace());
            }
        );

        if ($item) {
            return true;
        }

        return parent::has($key);
    }

    /**
     * Return only structured_data of a certain type.
     *
     * @param mixed $key
     * @return $this
     */
    public function type($key)
    {
        return $this->filter(
            function ($structured_datum) use ($key) {

                /* @var StructuredDatumInterface $structured_datum */
                return str_is($key, $structured_datum->getExtensionSlug()) || str_is($key, $structured_datum->getExtensionNamespace());
            }
        );
    }

    /**
     * Render the structured_data.
     *
     * @param array $payload
     * @return string
     */
    public function render(array $payload = [])
    {
        return implode(
            "\n\n",
            $this->undecorate()->map(
                function (StructuredDatumInterface $structured_datum) use ($payload) {
                    return $structured_datum->render($payload);
                }
            )->all()
        );
    }

    /**
     * Return the string value.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
