<?php

namespace Database\Seeders;

use App\Models\Formula;
use App\Models\Label;
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
        self::createUsers();
        self::createSettings();
        $variables = self::createDefaultVariables();
        $labels = self::createDefaultLabels();
        self::createDefaultFormulaForLandPurchase($variables, $labels);
        self::createDefaultFormulaForParticipation($variables, $labels);
    }

    static function createUsers(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@mail.com',
        ]);
    }

    static function createSettings(): void
    {
        Setting::factory(1)->create();
    }

    static function createDefaultVariables(): array
    {
        $variables = [];

        $variable = Variable::create(['name' => __('variables.land_area'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['land_area'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.density_percentage'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['density_percentage'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.illegal_density_percentage'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['illegal_density_percentage'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.floors_count'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['floors_count'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.unit_per_floor'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['unit_per_floor'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.number_of_warehouses'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['number_of_warehouses'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.area_of_each_warehouse'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['area_of_each_warehouse'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.required_area_of_each_parking'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['required_area_of_each_parking'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.construction_cost_per_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['construction_cost_per_meter'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.selling_price_per_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['selling_price_per_meter'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.illegal_area_per_floor'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['illegal_area_per_floor'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.cost_per_illegal_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['cost_per_illegal_meter'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.builder_percentage'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['builder_percentage'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.over'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['over'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.land_purchase_price_per_meter'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['land_purchase_price_per_meter'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.land_price'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['land_price'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.real_estate_commission_fee'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['real_estate_commission_fee'] = $variable->id;
        $variable = Variable::create(['name' => __('variables.other_expenses'), 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $variables['other_expenses'] = $variable->id;

        return $variables;
    }

    static function createDefaultLabels(): array
    {
        $labels = [];

        $label = Label::create(['name' => __('labels.total_expense_and_profit'), 'is_parent' => true, 'parent_id' => null, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $child = Label::create(['name' => __('labels.total_expense'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_expense'] = $child->id;
        $child = Label::create(['name' => __('labels.total_profit'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_profit'] = $child->id;

        $label = Label::create(['name' => __('labels.land'), 'is_parent' => true, 'parent_id' => null, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $child = Label::create(['name' => __('labels.area'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['land_area'] = $child->id;
        $child = Label::create(['name' => __('labels.land_purchase_price_per_meter'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['land_purchase_price_per_meter'] = $child->id;
        $child = Label::create(['name' => __('labels.total_price'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['land_total_price'] = $child->id;

        $label = Label::create(['name' => __('labels.building'), 'is_parent' => true, 'parent_id' => null, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $child = Label::create(['name' => __('labels.floors_count'), 'is_parent' => false, 'unit' => 'number', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['floors_count'] = $child->id;
        $child = Label::create(['name' => __('labels.density_percentage'), 'is_parent' => false, 'unit' => 'percent', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['density_percentage'] = $child->id;
        $child = Label::create(['name' => __('labels.illegal_density_percentage'), 'is_parent' => false, 'unit' => 'percent', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['illegal_density_percentage'] = $child->id;
        $child = Label::create(['name' => __('labels.total_density'), 'is_parent' => false, 'unit' => 'percent', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_density'] = $child->id;
        $child = Label::create(['name' => __('labels.llegal_area_of_floor'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['llegal_area_of_floor'] = $child->id;
        $child = Label::create(['name' => __('labels.illegal_area_of_floor'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['illegal_area_of_floor'] = $child->id;
        $child = Label::create(['name' => __('labels.total_area_of_floor'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_area_of_floor'] = $child->id;
        $child = Label::create(['name' => __('labels.unit_per_floor'), 'is_parent' => false, 'unit' => 'number', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['unit_per_floor'] = $child->id;
        $child = Label::create(['name' => __('labels.total_units'), 'is_parent' => false, 'unit' => 'number', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_units'] = $child->id;
        $child = Label::create(['name' => __('labels.llegal_parking_count'), 'is_parent' => false, 'unit' => 'number', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['llegal_parking_count'] = $child->id;
        $child = Label::create(['name' => __('labels.total_area_of_units'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_area_of_units'] = $child->id;
        $child = Label::create(['name' => __('labels.total_area_of_warehouses'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_area_of_warehouses'] = $child->id;
        $child = Label::create(['name' => __('labels.total_area'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_area'] = $child->id;
        $child = Label::create(['name' => __('labels.builder_share_of_area'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['builder_share_of_area'] = $child->id;
        $child = Label::create(['name' => __('labels.selling_price_per_meter'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['selling_price_per_meter'] = $child->id;
        $child = Label::create(['name' => __('labels.total_value_of_units'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_value_of_units'] = $child->id;

        $label = Label::create(['name' => __('labels.expenses'), 'is_parent' => true, 'parent_id' => null, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $child = Label::create(['name' => __('labels.construction_cost_per_meter'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['construction_cost_per_meter'] = $child->id;
        $child = Label::create(['name' => __(key: 'labels.over'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['over'] = $child->id;
        $child = Label::create(['name' => __('labels.real_estate_commission_fee'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['real_estate_commission_fee'] = $child->id;
        $child = Label::create(['name' => __('labels.other_expenses'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['other_expenses'] = $child->id;
        $child = Label::create(['name' => __('labels.total_construction_cost'), 'is_parent' => false, 'unit' => 'toman', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_construction_cost'] = $child->id;

        $label = Label::create(['name' => __('labels.unit'), 'is_parent' => true, 'parent_id' => null, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $child = Label::create(['name' => __('labels.area'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['unit_area'] = $child->id;
        $child = Label::create(['name' => __('labels.warehouse_area'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['warehouse_area'] = $child->id;
        $child = Label::create(['name' => __('labels.total_area_per_unit'), 'is_parent' => false, 'unit' => 'meter', 'parent_id' => $label->id, 'user_id' => null, 'created_at' => Carbon::create(1990, 1, 1), 'updated_at' => Carbon::create(1990, 1, 1)]);
        $labels['total_area_per_unit'] = $child->id;

        return $labels;
    }

    static function createDefaultFormulaForLandPurchase(array $variables, array $labels)
    {
        $formula = null;
        // Buy
        /**
         * <land_area> = #land_area#
         * <land_purchase_price_per_meter> = #land_purchase_price_per_meter#
         * <land_total_price> = #land_purchase_price_per_meter#*#land_area#
         * 
         * <floors_count> = #floors_count#
         * <density_percentage> = #density_percentage#
         * <illegal_density_percentage> = #illegal_density_percentage#
         * <total_density> = #density_percentage#+#illegal_density_percentage#
         * 
         * <llegal_area_of_floor> = (#land_area#*#density_percentage#)/100
         * <illegal_area_of_floor> = (#land_area#*#illegal_density_percentage#)/100
         * <total_area_of_floor> = <llegal_area_of_floor>+<illegal_area_of_floor>+#illegal_area_per_floor#
         * <total_area> = <total_area_of_floor>*#floors_count#
         * 
         * <unit_per_floor> = #unit_per_floor#
         * <total_units> = #unit_per_floor#*#floors_count#
         * <llegal_parking_count> = <total_area_of_floor>/#required_area_of_each_parking#
         * <total_area_of_warehouses> = #area_of_each_warehouse#*#number_of_warehouses#
         * 
         * <selling_price_per_meter> = #selling_price_per_meter#
         * 
         * <total_construction_cost> = ((<total_area>+<total_area_of_warehouses>)*#construction_cost_per_meter#)+(#cost_per_illegal_meter#*(#illegal_area_per_floor#+<illegal_area_of_floor>)*#floors_count#)
         * <total_area_of_units> = <total_area>+<total_area_of_warehouses>
         * <total_value_of_units> = <total_area_of_units>*#selling_price_per_meter#
         * <construction_cost_per_meter> = #construction_cost_per_meter#
         * <over> = #over#
         * <real_estate_commission_fee> = #real_estate_commission_fee#
         * <other_expenses> = #other_expenses#
         * <total_expense> = <total_construction_cost>+<land_total_price>+<other_expenses>+<real_estate_commission_fee>
         * <total_profit> = <total_value_of_units>-<total_expense>
         * 
         * // <builder_share_of_area> = (<total_area_of_units>*#builder_percentage#)/100
         * // <total_expense> = <total_construction_cost>+<other_expenses>+<real_estate_commission_fee>+<over>
         * // <total_profit> = <total_value_of_units>-<total_expense>-(<builder_share_of_area> * #selling_price_per_meter#)
         * 
         * <unit_area> = <llegal_area_of_floor>/#unit_per_floor#+((<illegal_area_of_floor>+#illegal_area_per_floor#) / #unit_per_floor#)
         * <warehouse_area> = #area_of_each_warehouse#
         * <total_area_per_unit> = <unit_area> + <warehouse_area>
         */

        $formula = '#' . $variables['land_area'] . '#=<' . $labels['land_area'] . '>';
        $formula .= '#' . $variables['land_purchase_price_per_meter'] . '#=<' . $labels['land_purchase_price_per_meter'] . '>';
        $formula .= '#' . $variables['land_purchase_price_per_meter'] . '#*#' . $variables['land_area'] . '#=<' . $labels['land_total_price'] . '>';
        $formula .= '#' . $variables['floors_count'] . '#=<' . $labels['floors_count'] . '>';
        $formula .= '#' . $variables['density_percentage'] . '#=<' . $labels['density_percentage'] . '>';
        $formula .= '#' . $variables['illegal_density_percentage'] . '#=<' . $labels['illegal_density_percentage'] . '>';
        $formula .= '#' . $variables['density_percentage'] . '#+#' . $variables['illegal_density_percentage'] . '#=<' . $labels['total_density'] . '>';
        $formula .= '(#' . $variables['land_area'] . '#*#' . $variables['density_percentage'] . '#)/100=<' . $labels['llegal_area_of_floor'] . '>';
        $formula .= '(#' . $variables['land_area'] . '#*#' . $variables['illegal_density_percentage'] . '#)/100+#' . $variables['illegal_area_per_floor'] . '#=<' . $labels['illegal_area_of_floor'] . '>';
        $formula .= '<' . $labels['llegal_area_of_floor'] . '>+<' . $labels['illegal_area_of_floor'] . '>+#' . $variables['illegal_area_per_floor'] . '#=<' . $labels['total_area_of_floor'] . '>';
        $formula .= '<' . $labels['total_area_of_floor'] . '>*#' . $variables['floors_count'] . '#=<' . $labels['total_area'] . '>';
        $formula .= '#' . $variables['unit_per_floor'] . '#=<' . $labels['unit_per_floor'] . '>';
        $formula .= '#' . $variables['unit_per_floor'] . '#*#' . $variables['floors_count'] . '#=<' . $labels['total_units'] . '>';
        $formula .= '<' . $labels['total_area_of_floor'] . '>/#' . $variables['required_area_of_each_parking'] . '#=<' . $labels['llegal_parking_count'] . '>';
        $formula .= '#' . $variables['area_of_each_warehouse'] . '#*#' . $variables['number_of_warehouses'] . '#=<' . $labels['total_area_of_warehouses'] . '>';
        $formula .= '#' . $variables['selling_price_per_meter'] . '#=<' . $labels['selling_price_per_meter'] . '>';
        $formula .= '((<' . $labels['total_area'] . '>+<' . $labels['total_area_of_warehouses'] . '>)*#' . $variables['construction_cost_per_meter'] . '#)+(#' . $variables['cost_per_illegal_meter'] . '#*(#' . $variables['illegal_area_per_floor'] . '#+<' . $labels['illegal_area_of_floor'] . '>)*#' . $variables['floors_count'] . '#)=<' . $labels['total_construction_cost'] . '>';
        $formula .= '<' . $labels['total_area'] . '>+<' . $labels['total_area_of_warehouses'] . '>=<' . $labels['total_area_of_units'] . '>';
        $formula .= '<' . $labels['total_area_of_units'] . '>*#' . $variables['selling_price_per_meter'] . '#=<' . $labels['total_value_of_units'] . '>';
        $formula .= '<' . $labels['llegal_area_of_floor'] . '>/#' . $variables['unit_per_floor'] . '#+((<' . $labels['illegal_area_of_floor'] . '>+#' . $variables['illegal_area_per_floor'] . '#)/#' . $variables['unit_per_floor'] . '#)=<' . $labels['unit_area'] . '>';
        $formula .= '#' . $variables['area_of_each_warehouse'] . '#=<' . $labels['warehouse_area'] . '>';
        $formula .= '<' . $labels['unit_area'] . '>+<' . $labels['warehouse_area'] . '>=<' . $labels['total_area_per_unit'] . '>';
        $formula .= '#' . $variables['construction_cost_per_meter'] . '#=<' . $labels['construction_cost_per_meter'] . '>';
        // $formula .= '#' . $variables['over'] . '#=<' . $labels['over'] . '>';
        $formula .= '#' . $variables['real_estate_commission_fee'] . '#=<' . $labels['real_estate_commission_fee'] . '>';
        $formula .= '#' . $variables['other_expenses'] . '#=<' . $labels['other_expenses'] . '>';
        $formula .= '<' . $labels['total_construction_cost'] . '>+<' . $labels['land_total_price'] . '>+<' . $labels['other_expenses'] . '>+<' . $labels['real_estate_commission_fee'] . '>=<' . $labels['total_expense'] . '>';
        $formula .= '<' . $labels['total_value_of_units'] . '>-<' . $labels['total_expense'] . '>=<' . $labels['total_profit'] . '>';

        self::addFormulaToDatabase(__('app.land_purchase'), $formula);
    }

    static function createDefaultFormulaForParticipation(array $variables, array $labels): void
    {
        $formula = null;

        $formula = '#' . $variables['land_area'] . '#=<' . $labels['land_area'] . '>';
        $formula .= '#' . $variables['floors_count'] . '#=<' . $labels['floors_count'] . '>';
        $formula .= '#' . $variables['density_percentage'] . '#=<' . $labels['density_percentage'] . '>';
        $formula .= '#' . $variables['illegal_density_percentage'] . '#=<' . $labels['illegal_density_percentage'] . '>';
        $formula .= '#' . $variables['density_percentage'] . '#+#' . $variables['illegal_density_percentage'] . '#=<' . $labels['total_density'] . '>';
        $formula .= '(#' . $variables['land_area'] . '#*#' . $variables['density_percentage'] . '#)/100=<' . $labels['llegal_area_of_floor'] . '>';
        $formula .= '(#' . $variables['land_area'] . '#*#' . $variables['illegal_density_percentage'] . '#)/100+#' . $variables['illegal_area_per_floor'] . '#=<' . $labels['illegal_area_of_floor'] . '>';
        $formula .= '<' . $labels['llegal_area_of_floor'] . '>+<' . $labels['illegal_area_of_floor'] . '>+#' . $variables['illegal_area_per_floor'] . '#=<' . $labels['total_area_of_floor'] . '>';
        $formula .= '<' . $labels['total_area_of_floor'] . '>*#' . $variables['floors_count'] . '#=<' . $labels['total_area'] . '>';
        $formula .= '#' . $variables['unit_per_floor'] . '#=<' . $labels['unit_per_floor'] . '>';
        $formula .= '#' . $variables['unit_per_floor'] . '#*#' . $variables['floors_count'] . '#=<' . $labels['total_units'] . '>';
        $formula .= '<' . $labels['total_area_of_floor'] . '>/#' . $variables['required_area_of_each_parking'] . '#=<' . $labels['llegal_parking_count'] . '>';
        $formula .= '#' . $variables['area_of_each_warehouse'] . '#*#' . $variables['number_of_warehouses'] . '#=<' . $labels['total_area_of_warehouses'] . '>';
        $formula .= '#' . $variables['selling_price_per_meter'] . '#=<' . $labels['selling_price_per_meter'] . '>';
        $formula .= '((<' . $labels['total_area'] . '>+<' . $labels['total_area_of_warehouses'] . '>)*#' . $variables['construction_cost_per_meter'] . '#)+(#' . $variables['cost_per_illegal_meter'] . '#*(#' . $variables['illegal_area_per_floor'] . '#+<' . $labels['illegal_area_of_floor'] . '>)*#' . $variables['floors_count'] . '#)=<' . $labels['total_construction_cost'] . '>';
        $formula .= '<' . $labels['total_area'] . '>+<' . $labels['total_area_of_warehouses'] . '>=<' . $labels['total_area_of_units'] . '>';
        $formula .= '<' . $labels['total_area_of_units'] . '>*#' . $variables['selling_price_per_meter'] . '#=<' . $labels['total_value_of_units'] . '>';
        $formula .= '<' . $labels['llegal_area_of_floor'] . '>/#' . $variables['unit_per_floor'] . '#+((<' . $labels['illegal_area_of_floor'] . '>+#' . $variables['illegal_area_per_floor'] . '#)/#' . $variables['unit_per_floor'] . '#)=<' . $labels['unit_area'] . '>';
        $formula .= '#' . $variables['area_of_each_warehouse'] . '#=<' . $labels['warehouse_area'] . '>';
        $formula .= '<' . $labels['unit_area'] . '>+<' . $labels['warehouse_area'] . '>=<' . $labels['total_area_per_unit'] . '>';
        $formula .= '#' . $variables['construction_cost_per_meter'] . '#=<' . $labels['construction_cost_per_meter'] . '>';
        $formula .= '#' . $variables['over'] . '#=<' . $labels['over'] . '>';
        $formula .= '#' . $variables['real_estate_commission_fee'] . '#=<' . $labels['real_estate_commission_fee'] . '>';
        $formula .= '#' . $variables['other_expenses'] . '#=<' . $labels['other_expenses'] . '>';
        $formula .= '(<' . $labels['total_area_of_units'] . '>*#' . $variables['builder_percentage'] . '#)/100=<' . $labels['builder_share_of_area'] . '>';
        $formula .= '<' . $labels['total_construction_cost'] . '>+<' . $labels['other_expenses'] . '>+<' . $labels['real_estate_commission_fee'] . '>+<' . $labels['over'] . '>=<' . $labels['total_expense'] . '>';
        $formula .= '<' . $labels['total_value_of_units'] . '>-<' . $labels['total_expense'] . '>-(<' . $labels['builder_share_of_area'] . '>*#' . $variables['selling_price_per_meter'] . '#)=<' . $labels['total_profit'] . '>';

        self::addFormulaToDatabase(__('app.participation'), $formula);
    }

    static function addFormulaToDatabase($name, $payload, $user = null)
    {
        Formula::create([
            'name' => $name,
            'payload' => $payload,
            'user_id' => $user,
            'created_at' => Carbon::create(1990, 1, 1),
            'updated_at' => Carbon::create(1990, 1, 1)
        ]);
    }
}
