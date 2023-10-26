@extends('layouts.admin')

@section('content')

@include('admin.blocks.csv.csv_files_block', [
    'head' => 'CSV-'.trans('admin.files_of_works'),
    'files' => $csvs_works,
    'path' => '/csvs_works/',
    'generateUrl' => route('admin.generate_csv_works'),
    'deleteUrl' => route('admin.delete_csv_works')
])

@include('admin.blocks.csv.csv_files_block', [
    'head' => 'CSV-'.trans('admin.files_of_sub_works'),
    'files' => $csvs_sub_works,
    'path' => '/csvs_sub_works/',
    'generateUrl' => route('admin.generate_csv_sub_works'),
    'deleteUrl' => route('admin.delete_csv_sub_works')
])

@can('edit')
    @include('admin.blocks.csv.parser_file_block', [
        'name' => 'csv_works',
        'head' => 'CSV-'.trans('admin.file_of_works'),
        'url' => route('admin.repair_parser_works')
    ])
    @include('admin.blocks.csv.parser_file_block', [
        'name' => 'csv_sub_works',
        'head' => 'CSV-'.trans('admin.file_of_sub_works'),
        'url' => route('admin.repair_parser_sub_works')
    ])
@endcan

@endsection
