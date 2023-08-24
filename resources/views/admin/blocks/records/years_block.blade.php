@if (count($years))
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="years">
                @foreach($years as $year)
                    @include('admin.blocks.records.year_block',['year' => $year])
                @endforeach
            </div>
        </div>
    </div>
@endif
