@extends('layouts.master')

@section('content')

<div class="col-12">
    <app-near-by-select
        :places="{{json_encode($places)}}"
        :id="'{{app('request')->input('near_by_id')}}'">

    </app-near-by-select>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Area</th>
            @if(!app('request')->input('order_by') || app('request')->input('order_by') == 'alphabet')
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
            @endif
            @if(app('request')->input('order_by') == 'near_by')
                <th scope="col">Distance, kms</th>
            @endif
        </tr>
        </thead>
        <tbody>
            @foreach($places as $place)
                <tr>
                    <th scope="row">{{$place->id}}</th>
                    <td>{{$place->name}}</td>
                    @if(!app('request')->input('order_by') || app('request')->input('order_by') == 'alphabet')
                        <td>{{$place->lat}}</td>
                        <td>{{$place->lng}}</td>
                    @endif
                    @if(app('request')->input('order_by') == 'near_by')
                        <td>{{ceil($place->distance)}}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection