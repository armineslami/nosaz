<?php

namespace Database\Seeders;

use App\Models\Variable;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // self::createUsers();
        // self::createSettings();
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

    static function createVariables(): void
    {
        Variable::create(['name' => __('variables.land_area'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.density_percentage'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.illegal_density_percentage'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.number_of_floor'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.number_of_units_per_floor'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.number_of_warehouses'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.area_of_each_warehouse'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.construction_cost_per_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.selling_price_per_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.illegal_area_per_floor'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.cost_per_illegal_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.builder_percentage'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.over'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.land_purchase_price_per_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.land_price'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.real_estate_commission_fee'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        Variable::create(['name' => __('variables.other_expenses'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
    }
}
