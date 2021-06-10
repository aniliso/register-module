<?php

namespace Modules\Register\Events;

use Modules\Media\Contracts\DeletingMedia;

class CollateralWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $collateralClass;
    /**
     * @var int
     */
    private $collateralId;

    public function __construct($collateralId, $collateralClass)
    {
        $this->collateralClass = $collateralClass;
        $this->collateralId = $collateralId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->collateralId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->collateralClass;
    }
}
