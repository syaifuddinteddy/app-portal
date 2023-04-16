@extends('admin.layouts.container')
@section('title', 'Dashboard')
@section('title_description', 'Panel Dashboard')
@section('css')
    <link href="{{ URL::to('/engine/multiSelect/css/multi-select.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/engine/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/adminLTE/dist/css/skins/skin-green.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('body-class', 'skin-green')
@section('content')
{{--    {{ Html::ul($errors->all()) }}--}}
{{--    {{ Form::open(array('route' => 'categories-create-data','role' => 'form','method' => 'PUT')) }}--}}
{{--    <div class="box">--}}
{{--        @include('admin::categories.form')--}}
{{--        <div class="box-footer">--}}
{{--            <a href="{{ URL::route('categories-all') }}" class="btn btn-warning">Cancel</a>--}}
{{--            {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    {{ Form::close() }}--}}
@stop
@section('js')
    <script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('/engine/fastclick/fastclick.min.js') }}"></script>
@stop
