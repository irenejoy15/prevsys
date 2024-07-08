@extends('layouts.main')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.orange-coral.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.midnight-blue.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('evo-calendar/css/evo-calendar.royal-navy.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
<style>
    span.select2.select2-container.select2-container--default.select2-container--below.select2-container--open{
        width: 100% !important;
        font-size:12px !important;
        font-weight: bold;
    }

    span.select2.select2-container.select2-container--default.select2-container--below,span.select2.select2-container.select2-container--default {
        width: 100% !important;
        font-size:12px !important;
        font-weight: bold;
    }

    span.select2.select2-container.select2-container--default.select2-container--focus {
        width: 100% !important;
        font-size:12px !important;
        font-weight: bold;
    }

    span.select2-selection.select2-selection--single {
      height:35px !important;
      font-size:12px !important;
      font-weight: bold;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 35px;
      position: absolute;
      top: 1px;
      right: 1px;
      width: 20px;
    }
    .select2-container--default .select2-selection--single{
        border:1px solid #dee2e6 !important;
        font-size:12px !important;
        font-weight: bold;
    }

    .select2-container .select2-selection--single .select2-selection__rendered{
        margin-top:3px !important;
        font-size:12px !important;
        font-weight: bold;
    }
</style>
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


<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @include('includes.form_error')
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10">
                    <div class="midnight-blue" id="calendar"></div>
                </div>
                <div class="col-xl-2">
                    ALL
                    
                        
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Type-->
<div class="modal fade" id="modalCreate"  role="dialog" aria-labelledby="modalCreateCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1366px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold badge badge-primary" id="modalCreateLongTitle" style="font-size:16px;">PREV. MAINTENANCE CREATION</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-4">
                        <div class="form-group">
                           <label>LOCATION:</label>
                           <select id="location_ajax" class="form-control" form="create" name="location_create"></select>
                        </div>

                        <div class="form-group">
                            <label>FREQUENCY:</label>
                            <select id="frequency_ajax" class="form-control" form="create" name="frequency_create"></select>
                        </div>

                        <div class="form-group">
                            <label>INVENTORY:</label>
                            <select id="inventory_ajax" class="form-control" form="create" name="inventory_ajax"></select>
                        </div>

                        <div class="form-group">
                            <label>ASSIGNED:</label>
                            <input type="text" class="form-control" form="create" name="assigned">
                        </div>
                    </div>    

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="remarks1">Remarks1:</label>
                            <textarea form="create" class="form-control" name="remarks1" id="remarks1"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="remarks2">Remarks2:</label>
                            <textarea form="create" class="form-control" name="remarks2" id="remarks2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="remarks3">Remarks3:</label>
                            <textarea form="create" class="form-control" name="remarks3" id="remarks3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="remarks4">Remarks4:</label>
                            <textarea form="create" class="form-control" name="remarks4" id="remarks4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="remarks5">Remarks5:</label>
                            <textarea form="create" class="form-control" name="remarks5" id="remarks5"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <table class="table">
                            <thead class="text-center">
                                <th style="width: 60%;"></th>
                                <th style="width: 20%;">YES</th>
                                <th style="width: 20%;">NO</th>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>CUSTOM DATE</td>
                                    <td><input type="radio" form="create" name="custom_date" onchange="irene(1)"></td>
                                    <td><input type="radio" form="create" name="custom_date" onchange="irene(0)" checked></td>
                                </tr>
                            </tbody>
                        </table>

                        <table id="table-now" class="table">
                            <thead class="text-center">
                                <th style="width: 60%;"></th>
                                <th style="width: 20%;">YES</th>
                                <th style="width: 20%;">NO</th>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>1ST WEEK</td>
                                    <td><input type="radio" form="create" name="1st_week" value="1" checked></td>
                                    <td><input type="radio" form="create" name="1st_week" value="0"></td>
                                </tr>

                                <tr class="text-center">
                                    <td>2ND WEEK</td>
                                    <td><input type="radio" form="create" name="2st_week" value="1" checked></td>
                                    <td><input type="radio" form="create" name="2st_week" value="0"></td>
                                </tr>

                                <tr class="text-center">
                                    <td>3RD WEEK</td>
                                    <td><input type="radio" form="create" name="3rd_week" value="1" checked></td>
                                    <td><input type="radio" form="create" name="3rd_week" value="0"></td>
                                </tr>

                                <tr class="text-center">
                                    <td>4TH WEEK</td>
                                    <td><input type="radio" form="create" name="4th_week" value="1" checked></td>
                                    <td><input type="radio" form="create" name="4th_week" value="0"></td>
                                </tr>

                                <tr class="text-center">
                                    <td>ONE TIME</td>
                                    <td><input type="radio" form="create" name="is_onetime" value="1"></td>
                                    <td><input type="radio" form="create" name="is_onetime" value="0" checked></td>
                                </tr>
                            </tbody>
                        </table>

                        <table id="table-now-2" class="table" style="display: none;">
                            <thead class="text-center">
                                <th style="width: 60%;"></th>
                                <th style="width: 40%;">DATES</th>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>DATE FROM</td>
                                    <td><input class="form-control" type="date" form="create" name="date_form"></td>
                                </tr>

                                <tr class="text-center">
                                    <td>DATE TO</td>
                                    <td><input class="form-control" type="date" form="create" name="date_to"></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">CLOSE</button>
                {{ html()->submit('SAVE SCHEDULE')->id('create_type_button')->class('btn btn-outline-success')->attribute('form','store')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
            </div>
        </div>
    </div>
</div>

@include('includes.loading')
@endsection

@section('scripts')
<script src="{{asset('evo-calendar/js/evo-calendar.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$( "#location_ajax" ).select2({
    dropdownParent: $("#modalCreate"),
    ajax: { 
        url: '{{url("/location_ajax")}}',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
        return {
            _token: CSRF_TOKEN,
            search: params.term, 
            };
        },
        processResults: function (response) {
        return {
            results: response.data
            };
        },
        cache: true
    }

})

$( "#frequency_ajax" ).select2({
    dropdownParent: $("#modalCreate"),
    ajax: { 
        url: '{{url("/frequency_ajax")}}',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
        return {
            _token: CSRF_TOKEN,
            search: params.term, 
            };
        },
        processResults: function (response) {
        return {
            results: response.data
            };
        },
        cache: true
    }

})

$( "#inventory_ajax" ).select2({
    dropdownParent: $("#modalCreate"),
    ajax: { 
        url: '{{url("/inventory_ajax")}}',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
        return {
            _token: CSRF_TOKEN,
            search: params.term, 
            };
        },
        processResults: function (response) {
        return {
            results: response.data
            };
        },
        cache: true
    }

})
</script>
<script>
    // ONLOAD SYSTEM
    $("#calendar").evoCalendar({
        calendarEvents: [
        {
            id: 'bHay68s', // Event's ID (required)
            name: "New Year", // Event name (required)
            date: "July/15/2024", // Event date (required)
            type: "holiday", // Event type (required)
            everyYear: true // Same event every year (optional)
        },
        {
            name: "Vacation Leave",
            badge: "02/13 - 02/15", // Event badge (optional)
            date: ["July/22/2024", "July/30/2024"], // Date range
            description: "<a href='www.google.com'>TEST<a/>", // Event description (optional)
            type: "event",
            color: "#63d867" // Event custom color (optional)
        }
        ]
    });
    
    $("#calendar").on('selectYear', function(event, activeYear) {
        console.log(activeYear);
    });
    $('#calendar').on('selectMonth', function(event, activeMonth, monthIndex) {
         // code here...
    console.log(monthIndex);
    });
</script>
<script>
    function irene(flag){
        if(flag===0){
            document.getElementById('table-now').style.display = '';
            document.getElementById('table-now-2').style.display = 'none';
        }
        else{
            document.getElementById('table-now').style.display = 'none';
            document.getElementById('table-now-2').style.display = '';
        }
    }
</script>
@endsection