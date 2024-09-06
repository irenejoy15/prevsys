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
                    <div class="row">
                        <div class="irene-header col-sm-12"  style="border:1px solid white; !important">
                            <h3 id="main-title" class="text-center" style="padding-top:6px;">EVENT</h3>
                        </div>
                        
                        <div class="location col-sm-12"  style="border:1px solid white; !important">
                            <h5 id="main_location" class="text-center" style="padding-top:10px;">LOCATION</h3>
                        </div>
                       
                        <div class="col-sm-12 irenerow">
                            <input id="header_id_store" type="hidden" value="">
                            <div class="container-fluid">
                                <div style="color:white; font-weight:bold; font-size:15px;" class="pt-3 row">
                                    <div class="col-xl-6 text-center" >
                                        DETAILS
                                    </div>
                                    <div class="col-xl-6 text-center">
                                        HISTORY
                                    </div>
                                    <div class="col-xl-12">
                                        <hr class="irene-hr" style="margin-left:-30px; margin-right:-30px;">
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="tech_remarks">REMARK:</label>
                                            <textarea class="form-control" name="tech_remarks" id="tech_remarks"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="control_number">CONTROL NUMBER:</label>
                                            <input type="text" class="form-control" name="control_number" id="control_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="attachment">ATTACHMENT:</label>
                                            <input type="file" class="form-control" name="attachment" id="attachment">
                                        </div>

                                        <div class="form-group">
                                            <input onclick="finalize()" class="btn btn-success" style="width:100%;" type="submit" value="SAVE">
                                        </div>
                                    </div>
                                </div>
                            </div> 
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