@extends('web.layouts.layout')

@section('content')
<div class="container">
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row justify-content-start">
        @foreach($pharmacies as $pharmacy)
            <div class="col-md-4 mb-2 pharmacy_item" data-lat="{{$pharmacy->lat}}" data-lng="{{$pharmacy->lng}}" data-distance=".distance_{{$pharmacy->id}}">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">
                            {{$pharmacy->name}} <br>
                            <span><i class="fa fa-location-arrow"></i> <b>Distance: </b><span class="distance_{{$pharmacy->id}}"></span></span>
                        </p>
                    </div>
                    <div class="card-body">
                        <a href="#">
                            <img style="width: 200px" src="{{asset($pharmacy->photo ?? 'assets/web/images/pharmacy.png')}}" alt="">
                        </a>
                    </div>
                    <div class="card-footer">
                        <b>Address: </b> {{$pharmacy->address}}
                    </div>
                </div>
            </div>

        @endforeach
    </div>

</div>
@endsection

@section('js')
    <script src="{{asset('assets/web/js/home.js')}}"></script>
@endsection
