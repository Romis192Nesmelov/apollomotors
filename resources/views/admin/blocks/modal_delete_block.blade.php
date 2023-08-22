<x-modal
    class="delete-modal"
    id="{{ isset($id) ? $id : 'delete-modal' }}"
    head="{{ trans('admin.warning') }}"
    footer="1"
    yes_button="1"
    del-function="{{ route('admin.'.$action) }}"
>
    <h3 class="text-center">{{ $head }}</h3>
</x-modal>
