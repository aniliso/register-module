<?php

namespace Modules\Register\Events;

use Modules\Mediapress\Entities\Media;
use Modules\Media\Contracts\StoringMedia;

class CollateralWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Media
     */
    public $collateral;

    public function __construct($collateral, array $data)
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
