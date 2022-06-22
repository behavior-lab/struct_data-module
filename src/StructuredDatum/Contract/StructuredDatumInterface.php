<?php namespace BehaviorLab\StructDataModule\StructuredDatum\Contract;

use BehaviorLab\StructDataModule\StructuredDatum\StructuredDatumExtension;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface StructuredDatumInterface
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
interface StructuredDatumInterface extends EntryInterface
{

    /**
     * Return the rendered structured_datum.
     *
     * @param array $payload
     * @return string
     */
    public function render(array $payload = []);

    /**
     * Get the extension.
     *
     * @return StructuredDatumExtension
     */
    public function getExtension();

    /**
     * Get the extension slug.
     *
     * @return string
     */
    public function getExtensionSlug();

    /**
     * Get the extension namespace.
     *
     * @return string
     */
    public function getExtensionNamespace();

    /**
     * Return the loaded extension.
     *
     * @return StructuredDatumExtension
     */
    public function extension();

    /**
     * Return a setting value.
     *
     * @param      $key
     * @param null $default
     * @return FieldTypePresenter|null
     */
    public function setting($key, $default = null);

    /**
     * Return a configuration value.
     *
     * @param      $key
     * @param null $default
     * @return FieldTypePresenter|null
     */
    public function configuration($key, $default = null);

    /**
     * Get the title.
     *
     * @return null|string
     */
    public function getTitle();

    /**
     * Get the related entry.
     *
     * @return null|EntryInterface
     */
    public function getEntry();

    /**
     * Get the related entry's ID.
     *
     * @return null|int
     */
    public function getEntryId();

    /**
     * Get the related area.
     *
     * @return null|EntryInterface
     */
    public function getArea();

    /**
     * Get the content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Set the content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content);

    /**
     * Get the data.
     *
     * @return array
     */
    public function getData();

    /**
     * Set the data.
     *
     * @param array $data
     * @return $this
     */
    public function setData(array $data);

    /**
     * Add some data.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function addData($key, $value);

    /**
     * Return if the structured_datum has data by key.
     *
     * @param $key
     * @return bool
     */
    public function hasData($key);
}
