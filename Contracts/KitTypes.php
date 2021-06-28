<?php


namespace Modules\Register\Contracts;


class KitTypes
{
    const CARD = 1;
    const RING = 2;

    /**
     * @var array
     */
    private $kitTypes = [];

    public function __construct()
    {
        $this->kitTypes = [
            self::CARD => trans('register::forms.kit_types.card'),
            self::RING => trans('register::forms.kit_types.ring')
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->kitTypes;
    }

    public function toJson()
    {
        return json_encode($this->kitTypes);
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->kitTypes[$statusId])) {
            return $this->kitTypes[$statusId];
        }

        return $this->kitTypes[self::CARD];
    }
}