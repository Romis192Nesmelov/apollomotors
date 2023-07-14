@include('issues.blocks.currency_plate_block')
@include('issues.blocks.phone_plate_block')
@include('issues.blocks.prices_plate_block')

@include('blocks.online_record_block',[
    'type' => 'online_appointment_for_'.$activeMenu,
    'addClass' => 'mt-4 mb-4'
])
