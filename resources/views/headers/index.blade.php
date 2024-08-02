@extends('layouts.main')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.orange-coral.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.midnight-blue.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.royal-navy.min.css')}}"> --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
@include('includes.calendarcss')
@endsection

@section('title') 
    PREVENTIVE MAINTENANCE MODULES
@endsection 

@section('subtitle')
    Calendar
@endsection

@section('breadcrumbs_1')
    Maintenance
@endsection

@section('breadcrumbs_2')
    List
@endsection

@section('button')
    <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalCreate">ADD MAINTENANCE</button> 
@endsection

@section('main')

{!! html()->modelForm('POST', null)->class('form')->attribute('action',route('header.store'))->id('create')->acceptsFiles()->open() !!}
{!! html()->closeModelForm() !!} 

<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @include('includes.form_error')
                </div>
            </div>
            <div class="row">
                <div class="col-lx-12">
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div id='calendar'></div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="irenerow row">
                        <div class="irene-header col-sm-12"  style="border:1px solid white; !important">
                            <h3 id="main-title" class="text-center" style="padding-top:6px;">EVENT</h3>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.calendarmodals')
@include('includes.loading')
@endsection

@section('scripts')
@include('includes.calendar')
@endsection