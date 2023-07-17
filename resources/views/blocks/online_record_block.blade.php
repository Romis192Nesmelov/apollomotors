<div class="rounded-block online-record {{ isset($addClass) && $addClass ? $addClass : ''}}">
    <h2>{{ trans('content.'.(isset($type) ? $type : 'record_for_repair')) }}</h2>
    @include('blocks.request_form_block',['textarea' => false])
</div>
