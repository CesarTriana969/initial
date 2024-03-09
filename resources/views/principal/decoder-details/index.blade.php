@extends('layouts.app')

@section('content')

<div class="login__container w-full ">
    <decoder-details-component :decode-vin="{{ json_encode($decodeVin) }}"></decoder-details-component>
</div>

@endsection
