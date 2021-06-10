<?php

namespace Modules\Register\Repositories\Cache;

use Modules\Register\Repositories\FileRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheFileDecorator extends BaseCacheDecorator implements FileRepository
{
    public function __construct(FileRepository $file)
    {
        parent::__construct();
        $this->entityName = 'register.files';
        $this->repository = $file;
    }
}
