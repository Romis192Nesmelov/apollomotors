@include('blocks.input_block', [
    'label' => trans('admin.href'),
    'required' => true,
    'name' => 'slug',
    'type' => 'text',
    'max' => 255,
    'placeholder' => trans('admin.href'),
    'value' => $item ? $item->slug : ''
])

@foreach (['ru', 'en'] as $ending)
    @include('blocks.input_block', [
        'label' => trans('admin.name_'.$ending),
        'required' => true,
        'name' => 'name_'.$ending,
        'type' => 'text',
        'max' => 255,
        'placeholder' => trans('admin.name_'.$ending),
        'value' => $item ? $item['name_'.$ending] : ''
    ])
@endforeach
