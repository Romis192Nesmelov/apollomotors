<table class="w-100 pb-5">
    <tr>
        <td class="align-top"><i class="fs-1 icon-redo2 text-secondary"></i></td>
        <td class="align-top w-100 p-2"><p class="fs-6 text-uppercase">{!! trans('content.there_is_a_discount') !!}</p></td>
    </tr>
</table>
<form class="row" action="#">
    <div class="col-md-6 col-sm-12">
        @include('blocks.input_block',[
            'name' => 'user_name',
            'placeholder' => trans('content.your_name'),
            'ajax' => true
        ])
    </div>
    <div class="col-md-6 col-sm-12">
        @include('blocks.input_block',[
            'name' => 'phone',
            'placeholder' => '+7(___)___-__-__',
            'ajax' => true
        ])
    </div>
    <div class="col-12">
        @if ($textarea)
            @include('blocks.textarea_block',[
                'name' => 'comment',
                'placeholder' => trans('content.your_comment'),
                'rows' => 4,
                'ajax' => true
            ])
        @endif
        @include('blocks.checkbox_block',[
            'checked' => false,
            'name' => 'i_agree',
            'label' => trans('content.i_agree'),
        ])
        @include('blocks.button_block',[
            'addClass' => 'mt-5',
            'primary' => true,
            'buttonText' => trans('content.send')
        ])
    </div>
</form>
