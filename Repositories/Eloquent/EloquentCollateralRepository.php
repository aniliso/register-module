<?php

namespace Modules\Register\Repositories\Eloquent;

use Modules\Register\Events\CollateralWasCreated;
use Modules\Register\Events\CollateralWasDeleted;
use Modules\Register\Events\CollateralWasUpdated;
use Modules\Register\Repositories\CollateralRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCollateralRepository extends EloquentBaseRepository implements CollateralRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new CollateralWasCreated($model, $data));

        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new CollateralWasUpdated($model, $data));

        return $model;
    }

    public function destroy($model)
    {
        event(new CollateralWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }
}
