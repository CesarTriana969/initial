@extends('layouts.app')

@section('content')
<div class="container ml-8">
    <dashboard-component :clients="{{$clients}}" :leads="{{$leads}}" :quotes-request="{{$quotesRequest}}"></dashboard-component>
</div>
@endsection
