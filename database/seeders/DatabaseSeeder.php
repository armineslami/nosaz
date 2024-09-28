<?php

namespace Database\Seeders;

use App\Models\Operand;
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
        self::createOperands();
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

    static function createOperands(): void
    {
        Operand::create(['name' => __('operands.land_area')]);
        Operand::create(['name' => __('operands.density_percentage')]);
        Operand::create(['name' => __('operands.number_of_floor')]);
        Operand::create(['name' => __('operands.number_of_units_per_floor')]);
        Operand::create(['name' => __('operands.number_of_warehouses')]);
        Operand::create(['name' => __('operands.area_of_warehouse')]);
        Operand::create(['name' => __('operands.cost_per_meter')]);
        Operand::create(['name' => __('operands.selling_price_per_meter')]);
        Operand::create(['name' => __('operands.illegal_area_of_each_floor')]);
        Operand::create(['name' => __('operands.cost_per_illegal_meter')]);
        Operand::create(['name' => __('operands.constructor_share_percentage')]);
        Operand::create(['name' => __('operands.over')]);
        Operand::create(['name' => __('operands.land_purchase_price_per_meter')]);
        Operand::create(['name' => __('operands.land_price')]);
        Operand::create(['name' => __('operands.real_estate_commission_fee')]);
        Operand::create(['name' => __('operands.other_expenses')]);
    }
}
