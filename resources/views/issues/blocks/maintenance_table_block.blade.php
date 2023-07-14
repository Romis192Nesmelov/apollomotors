<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h2 class="w-100 text-center">{!! trans('maintenance.scheduled_maintenance_head',['car' => $car]) !!}</h2>
    <p>{!! trans('maintenance.when_operating_a_vehicle_in_difficult_conditions',['car' => $car]) !!}</p>
    <div class="big-table-container">
        <table class="app-data-table table-striped">
            @include('issues.blocks.repair_table_th_cells_row_type1_block',['text' => trans('maintenance.maintenance')])
            @include('issues.blocks.repair_table_th_cells_row_type2_block',['text' => trans('maintenance.year'), 'factor' => 1])
            @include('issues.blocks.repair_table_th_cells_row_type2_block',['text' => trans('maintenance.thousand_km'), 'factor' => 15])

            @include('issues.blocks.repair_table_colspan_row_block',['text' => trans('maintenance.at_the_time_of_car_pickup')])

            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_operation_of_instrumentation')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_clutch_operation')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_wipers')])

            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.inside_the_car')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_lamps')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.reset_indicators')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_parking_brake'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_seat_belts'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.cabin_filter_replacement')])

            @include('issues.blocks.repair_table_colspan_row_block',['text' => trans('maintenance.outside_the_car')])

            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_lock'), 'cellsToSkip' => [1,3,5,7,9]])

            @include('issues.blocks.repair_table_colspan_row_block',['text' => trans('maintenance.under_the_hood')])

            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.inspection_of_the_whole_persimmon'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.engine_inspection'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_coolant'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_fluid_level'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.power_steering_fluid_check'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.cleaning_the_battery_terminals'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.check_for_battery_leaks'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.replacement_of_automatic_transmission_fluid'), 'cellsToSkip' => [1,2,3,4,5,7,8,9,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.replacing_of_automatic_transmission_with_a_wet_clutch'), 'cellsToSkip' => [1,2,4,5,7,8,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.replacing_of_automatic_transmission_with_a_wet_clutch'), 'cellsToSkip' => [1,2,4,5,7,8,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.draining_water_from_the_fuel_filter'), 'cellsToSkip' => [3,6,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.fuel_filter_replacement1'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.fuel_filter_replacement2'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.fuel_filter_replacement3'), 'cellsToSkip' => [1,2,3,4,6,7,8,9,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.air_filter_replacement'), 'cellsToSkip' => [1,3,5,7,9]])

            @include('issues.blocks.repair_table_colspan_row_block',['text' => trans('maintenance.under_the_car')])

            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.draining_used_oil_and_replacing_the_oil_filter')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.check_of_a_condition_of_sites_of_a_steering'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_engine_transmission_rear_axle'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_fo_leaks_of_the_final_drive'), 'cellsToSkip' => [1,2,4,5,7,8,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_condition_of_the_drive_shafts'), 'cellsToSkip' => [1,2,4,5,7,8,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_pipeline'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.inspection_of_the_bottom_of_the_body'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.tire_check')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_brake_system1'), 'cellsToSkip' => [4,8]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_brake_system2'), 'cellsToSkip' => [1,2,3,5,6,7,9,10]])

            @include('issues.blocks.repair_table_colspan_row_block',['text' => trans('maintenance.outside_the_car')])

            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.draining_used_oil_and_replacing_the_oil_filter')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.tire_check')])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_expiration_date_of_a_tire_repair_kit'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_luggage_compartment_lamp'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.check_for_damage_to_rims'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.wheel_hub_damage_check'), 'cellsToSkip' => [1,3,5,7,9]])

            @include('issues.blocks.repair_table_colspan_row_block',['text' => trans('maintenance.maintenance_performed_at_extended_intervals')])

            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.brake_fluid_replacement'), 'cellsToSkip' => [1,3,5,7,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.checking_the_air_conditioning_system'), 'cellsToSkip' => [1,2,4,5,7,8,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.replacing_the_cooling_system_fluid'), 'cellsToSkip' => [1,2,3,4,6,7,8,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.timing_belt_replacement'), 'cellsToSkip' => [1,2,3,4,5,7,8,9,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.timing_chain_check'), 'cellsToSkip' => [1,2,3,4,6,7,8,9]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.v_ribbed_belt_check'), 'cellsToSkip' => [1,2,4,5,7,8,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.oil_change_in_manual_transmission'), 'cellsToSkip' => [1,2,3,4,5,6,8,9,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.oil_change_in_manual_transmission'), 'cellsToSkip' => [1,2,3,4,5,6,8,9,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.oil_change_in_manual_transmission'), 'cellsToSkip' => [1,2,3,4,5,6,8,9,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.oil_change_in_haldex'), 'cellsToSkip' => [1,2,4,5,7,8,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.power_steering_oil_change'), 'cellsToSkip' => [1,2,3,4,5,6,8,9,10]])
            @include('issues.blocks.repair_table_td_cells_row_block',['text' => trans('maintenance.visual_inspection_of_the_body')])
        </table>
    </div>

    <p class="subscript">{!! trans('maintenance.in_case_of_abnormal_loss_of_working_fluid') !!}</p>
    <h5>{!! trans('maintenance.maintenance_is') !!}:</h5>
    <ul>
        @for ($i=1;$i<=6;$i++)
            <li>{!! trans('maintenance.maintenance_is'.$i, ['car' => $car]) !!}</li>
        @endfor
    </ul>

</div>
