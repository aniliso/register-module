<?php namespace Modules\Register\Contracts;

class FuelTypes
{
    const GAS = 1;
    const DIESEL = 2;

    /**
     * @var array
     */
    private $fuelTypes = [];

    public function __construct()
    {
        $this->fuelTypes = [
            self::GAS => trans('register::forms.fuel_types.gas'),
            self::DIESEL => trans('register::forms.fuel_types.diesel')
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->fuelTypes;
    }

    public function toJson()
    {
        return json_encode($this->fuelTypes);
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->fuelTypes[$statusId])) {
            return $this->fuelTypes[$statusId];
        }

        return $this->fuelTypes[self::GAS];
    }
}
