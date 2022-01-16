<?php

namespace Modules\Register\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Register\Repositories\FormRepository;
use Modules\Register\Services\CollateralService;

class DiscountRateTableSeeder extends Seeder
{
    /**
     * @var FormRepository
     */
    private $form;

    public function __construct(FormRepository $form)
    {
        $this->form = $form;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $forms = $this->form->all();

        foreach ($forms as $form) {
            $collateral = new CollateralService($form);
            $rate = $collateral->findRangeRate();
            if(empty($form->discount_rate)) {
                $this->form->update($form, ['discount_rate' => $rate['percent']]);
            }
        }

        // $this->call("OthersTableSeeder");
    }
}
