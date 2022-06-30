<?php namespace ConductLab\StructDataModule\Extension;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExtensionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var ExtensionModel
     */
    protected $model = ExtensionModel::class;


    /**
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [];
    }
}
