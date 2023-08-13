<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">SEO</h5>
        @include('admin.blocks.heading_elements_block')
    </div>
    <div class="panel-body" style="display: none;">
        @include('blocks.input_block', [
            'label' => 'Title',
            'required' => false,
            'name' => 'title',
            'type' => 'text',
            'max' => 255,
            'placeholder' => 'Title',
            'value' => $pos !== false ? (isset($item[0]) && isset($item[0]->seo) ? $item[0]->seo->title : '') : (isset($item) && isset($item->seo) ? $item->seo->title : '')
        ])
        @include('admin.blocks.textarea_block',[
            'required' => false,
            'name' => 'keywords',
            'label' => 'Keywords',
            'simple' => true,
            'value' => $pos !== false ? (isset($item[0]) && isset($item[0]->seo) ? $item[0]->seo->keywords : '') : (isset($item) && isset($item->seo) ? $item->seo->keywords : '')
        ])
        @include('admin.blocks.textarea_block',[
            'required' => false,
            'name' => 'description',
            'label' => 'Description',
            'simple' => true,
            'value' => $pos !== false ? (isset($item[0]) && isset($item[0]->seo) ? $item[0]->seo->description : '') : (isset($item) && isset($item->seo) ? $item->seo->description : '')
        ])
    </div>
</div>
