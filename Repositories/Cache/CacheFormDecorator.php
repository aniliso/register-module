<?php

namespace Modules\Register\Repositories\Cache;

use Modules\Register\Repositories\FormRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheFormDecorator extends BaseCacheDecorator implements FormRepository
{
    public function __construct(FormRepository $form)
    {
        parent::__construct();
        $this->entityName = 'register.forms';
        $this->repository = $form;
    }
}
