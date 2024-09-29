<?php

namespace Database\Seeders;

use App\Models\Variable;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        self::createUsers();
        self::createSettings();
        self::createVariables();
    }

    static function createUsers(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    static function createSettings(): void
    {
        Setting::factory(1)->create();
    }

//    static function createOperations(): void
//    {
//        Operation::create(['symbol' => '+']);
//        Operation::create(['symbol' => '/']);
//        Operation::create(['symbol' => '-']);
//        Operation::create(['symbol' => '*']);
//        Operation::create(['symbol' => '(']);
//        Operation::create(['symbol' => ')']);
//        Operation::create(['symbol' => '^']);
//        Operation::create(['symbol' => '%']);
//        Operation::create(['symbol' => '=']);
//    }

    static function createVariables(): void
    {
        Variable::create(['name' => __('variables.land_area')]);
        Variable::create(['name' => __('variables.density_percentage')]);
        Variable::create(['name' => __('variables.number_of_floor')]);
        Variable::create(['name' => __('variables.number_of_units_per_floor')]);
        Variable::create(['name' => __('variables.number_of_warehouses')]);
        Variable::create(['name' => __('variables.area_of_warehouse')]);
        Variable::create(['name' => __('variables.cost_per_meter')]);
        Variable::create(['name' => __('variables.selling_price_per_meter')]);
        Variable::create(['name' => __('variables.illegal_area_of_each_floor')]);
        Variable::create(['name' => __('variables.cost_per_illegal_meter')]);
        Variable::create(['name' => __('variables.constructor_share_percentage')]);
        Variable::create(['name' => __('variables.over')]);
        Variable::create(['name' => __('variables.land_purchase_price_per_meter')]);
        Variable::create(['name' => __('variables.land_price')]);
        Variable::create(['name' => __('variables.real_estate_commission_fee')]);
        Variable::create(['name' => __('variables.other_expenses')]);
    }
}
