<?php


namespace Modules\Register\Composers;


use Illuminate\Contracts\View\View;
use Modules\Register\Repositories\CollateralRepository;

class CollateralComposer
{
    /**
     * @var CollateralRepository
     */
    private $collateral;

    public function __construct(CollateralRepository $collateral)
    {

        $this->collateral = $collateral;
    }

    public function compose(View $view)
    {
        $collateralTypes = $this->collateral->all()->map(function ($collateral) {
            return [
                'id'    => $collateral->id,
                'title' => $collateral->title,
                'code'  => $collateral->code
            ];
        });
        $view->with('collateralTypes', $collateralTypes);
    }
}