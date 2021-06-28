<?php


namespace Modules\Register\Composers;


use Illuminate\Contracts\View\View;
use Modules\Register\Contracts\FuelTypes;
use Modules\Register\Contracts\KitTypes;

class FormTypesComposer
{
    /**
     * @var FuelTypes
     */
    private $fuelTypes;
    /**
     * @var KitTypes
     */
    private $kitTypes;

    public function __construct(FuelTypes $fuelTypes, KitTypes $kitTypes)
    {

        $this->fuelTypes = $fuelTypes;
        $this->kitTypes = $kitTypes;
    }

    public function compose(View $view)
    {
        $fuelTypes = $this->fuelTypes;
        $kitTypes = $this->kitTypes;

        $view->with('fuelTypes', $fuelTypes);
        $view->with('kitTypes', $kitTypes);
    }
}