<?php namespace BehaviorLab\StructDataModule\Extension;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use BehaviorLab\StructDataModule\Extension\Contract\ExtensionInterface;
use Anomaly\Streams\Platform\Model\StructData\StructDataExtensionsEntryModel;

class ExtensionModel extends StructDataExtensionsEntryModel implements ExtensionInterface
{
    protected $appends = ['extension', 'title', 'slug', 'description'];

    public function getExtensionAttribute()
    {
        $extensions = app(ExtensionCollection::class);
//        dd($extensions->find($this->provider));
        return $extensions->find($this->provider);
    }

    public function getSlugAttribute()
    {
        return $this->getExtensionAttribute()->getSlug();
    }

    public function getTitleAttribute() {
        return $this->getExtensionAttribute()->getTitle();
    }

    public function getDescriptionAttribute() {
        return $this->getExtensionAttribute()->getDescription();
    }
}
