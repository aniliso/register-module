<?php

namespace Modules\Register\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Register\Repositories\CollateralRepository;

class RegisterDatabaseSeeder extends Seeder
{
    /**
     * @var CollateralRepository
     */
    private $collateral;

    public function __construct(CollateralRepository $collateral)
    {
        $this->collateral = $collateral;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $data = [
            [
                'title' => 'Kredi Kartı Bloke',
                'code'  => 'credit-card',
                'rates' => "1;1;0-13500;5.00\n2;2;13501-55000;5.5\n3;3;55001-135000;6\n4;4;135001-270000;6.5\n5;5;270001-999000;7"
            ],
            [
                'title' => 'DBS',
                'code'  => 'dbs',
                'rates' => "1;1;0-13500;6.00\n2;2;13501-55000;6.5\n3;3;55001-135000;7\n4;4;135001-270000;7.5\n5;5;270001-999000;8"

            ],
            [
                'title' => 'Teminat Mektubu',
                'code'  => 'letter-of-guarantee',
                'rates' => "1;1;0-13500;6.00\n2;2;13501-55000;6.5\n3;3;55001-135000;7\n4;4;135001-270000;7.5\n5;5;270001-999000;8"
            ]
        ];

        foreach ($data as $d) {
            $this->collateral->create($d);
        }
    }
}
