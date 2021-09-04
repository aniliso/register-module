<?php

namespace Modules\Register\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Register\Repositories\FormRepository;

class VehicleTableSeeder extends Seeder
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
            if ($form->credit_card) {
                if (isset($form->credit_card->cars)) {
                    $form->vehicles = $form->credit_card->cars;
                    $form->save();
                }
            }
        }

        // $this->call("OthersTableSeeder");
    }
}
