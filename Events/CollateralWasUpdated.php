<?php

namespace Modules\Register\Events;

use Modules\Media\Contracts\StoringMedia;
use Modules\Register\Entities\Collateral;

class CollateralWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Collateral
     */
    public $collateral;

    public function __construct(Collateral $collateral, array $data)
    {
        $this->data = $data;
        $this->collateral = $collateral;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->collateral;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
