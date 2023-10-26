<div class="panel panel-flat">
    <div class="panel-heading">
        <h4 class="panel-title">{{ $head }}</h4>
    </div>
    <div class="panel-body">
        @php $passIds = []; $filesCounter = 0; $totalFilesCounter = 0; @endphp
        @can('delete')
            @if (count($files))
                <form class="form-horizontal" action="{{ $deleteUrl }}" method="post">
                    @csrf
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <ul class="csv-files">
                                    @foreach($files as $filePath)
                                        @foreach($brands as $brand)
                                            @php
                                                $fileName = str_replace(base_path('public'.$path),'',$filePath);
                                                if (preg_match('/^('.$brand->name_en.')/',$fileName) && !in_array($brand->id,$passIds)) {
                                                    $passIds[] = $brand->id;
                                                }
                                            @endphp
                                        @endforeach
                                        <li>
                                            @include('blocks.checkbox_block', [
                                                'name' => pathinfo($fileName)['filename'],
                                                'checked' => false,
                                                'addAttr' => ['style' => 'margin-bottom:0px'],
                                                'label' => '<a href="'.asset($path.$fileName).'">'.view('blocks.cropped_content_block', ['content' => $fileName, 'length' => 50])->render().'</a>'
                                            ])
                                        </li>
                                        @php $filesCounter++; $totalFilesCounter++; @endphp
                                        @if ($filesCounter == 11 && count($files) != $totalFilesCounter)
                                            @php $filesCounter = 0; @endphp
                                            {!! '</ul></div></div></div><div class="col-md-3 col-sm-4 col-xs-12"><div class="panel panel-flat"><div class="panel-body"><ul class="csv-files">' !!}
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('blocks.checkbox_block', [
                                    'name' => 'check_all',
                                    'checked' => false,
                                    'label' => trans('admin.check_all')
                                ])
                                @include('blocks.button_block', [
                                    'buttonType' => 'submit',
                                    'addClass' => 'mt-3',
                                    'icon' => 'icon-file-minus2',
                                    'buttonText' => trans('admin.delete_checked')
                                ])
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        @endcan
        <form class="form-horizontal col-md-12 col-sm-12 col-xs-12" action="{{ $generateUrl }}" method="post">
            @csrf
            <div class="panel panel-flat">
                <div class="panel-body">
                    @foreach($brands as $brand)
                        @include('blocks.checkbox_block', [
                            'name' => 'brands_id'.$brand->id,
                            'addAttr' => ['style' => 'margin-bottom:0px'],
                            'checked' => !in_array($brand->id,$passIds),
                            'label' => trans('admin.for').ucfirst($brand->name_en),
                            'noGap' => true
                        ])
                    @endforeach
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="panel-body">
                    @include('blocks.button_block', [
                        'buttonType' => 'submit',
                        'addClass' => 'pull-left',
                        'icon' => 'icon-file-spreadsheet',
                         'buttonText' => trans('admin.generate').' '.$head
                     ])
                </div>
            </div>
        </form>
    </div>
</div>
