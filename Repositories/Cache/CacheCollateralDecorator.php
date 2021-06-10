<?php

namespace Modules\Register\Repositories\Cache;

use Modules\Register\Repositories\CollateralRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCollateralDecorator extends BaseCacheDecorator implements CollateralRepository
{
    public function __construct(CollateralRepository $collateral)
    {
        parent::__construct();
        $this->entityName = 'register.collaterals';
        $this->repository = $collateral;
    }
}
