<div class="rounded-block online-record {{ isset($addClass) && $addClass ? $addClass : ''}}">
    <h2>{{ trans('content.record_for_repair') }}</h2>
    @include('blocks.request_form_block',['textarea' => false])
</div>
