@extends('layouts.main')

@section('styles')
@endsection

@section('title') 
    FREQUENCY MODULE
@endsection 

@section('subtitle')
    List of Frequency
@endsection

@section('breadcrumbs_1')
Frequency
@endsection

@section('breadcrumbs_2')
    List
@endsection

@section('button')
    <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalCreate">ADD FREQUENCY</button> 
@endsection

@section('main')
{!! html()->modelForm(null, null)->class('form')->id('search')->attribute('action',route('frequency.index'))->attribute('method','GET')->open() !!}
{!! html()->closeModelForm() !!}

{!! html()->modelForm('POST', null)->class('form')->attribute('action',route('frequency.store'))->id('store')->acceptsFiles()->open() !!}
{!! html()->closeModelForm() !!} 

{!! html()->modelForm('POST', null)->class('form')->attribute('action',route('update_frequency'))->id('update')->acceptsFiles()->open() !!}
{!! html()->closeModelForm() !!} 

<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @include('includes.form_error')
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                    {{ html()->label('SEARCH:')->attribute('style','font-weight:bold;')->attribute('for','search_frequency') }}
                    {{ html()->text('search',$search)->placeholder('ENTER FREQUENCY')->class('form-control ')->id('search_frequency')->attribute('style','font-weight:bold;')->attribute('form','search') }}
                </div>
                <div class="col-xl-2 col-lg-3 col-md-12 col-12" style="margin-top: 9px;">
                    <br>
                    {{ html()->submit('SEARCH')->class('btn btn-outline-success btn-block')->attribute('form','search')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
                </div>
                <div class="col-xl-3 col-lg-1 col-md-12 col-12"></div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-lg">
                        <thead class="table-dark">
                            <th class="text-center">FREQUENCY NAME</th>
                            <th class="text-center">ACTION</th>
                        </thead>
                        <tbody>
                            @if($frequencies->isEmpty())
                            @else
                                @foreach ($frequencies as $frequency)
                                    <tr>
                                        <td class="text-center">{{$frequency->frequency}}</td>
                                        <td class="text-center">
                                            <a onclick="edit('{!!$frequency->id!!}','{!!$frequency->frequency!!}','{!!$frequency->is_jan!!}','{!!$frequency->is_feb!!}','{!!$frequency->is_mar!!}','{!!$frequency->is_apr!!}','{!!$frequency->is_may!!}','{!!$frequency->is_jun!!}','{!!$frequency->is_jul!!}','{!!$frequency->is_aug!!}','{!!$frequency->is_sept!!}','{!!$frequency->is_oct!!}','{!!$frequency->is_nov!!}','{!!$frequency->is_dec!!}')" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                                <i class="mdi mdi-table-edit text-success"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$frequencies->render()}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Frequency Create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold badge badge-primary" id="modalCreateLongTitle" style="font-size:16px;">FREQUENCY CREATION</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            {{ html()->label('FREQUENCY NAME:')->attribute('style','font-weight:bold;')->attribute('for','frequency') }}
                            {{ html()->text('frequency')->class('form-control')->id('frequency')->attribute('style','font-weight:bold;')->attribute('form','store') }}
                        </div>
                    </div>    
                    <div class="col-sm-6">
                        <table class="table">
                            <thead>
                                <th>MONTH</th>
                                <th class="text-center">YES</th>
                                <th class="text-center">NO</th>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td>JANUARY</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_jan" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_jan" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>FEBUARY</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_feb" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_feb" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>MARCH</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_mar" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_mar" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>APRIL</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_apr" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_apr" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>MAY</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_may" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_may" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>JUNE</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_jun" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_jun" value="0" > 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table">
                            <thead>
                                <th>MONTH</th>
                                <th class="text-center">YES</th>
                                <th class="text-center">NO</th>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td>JULY</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_jul" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_jul" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>AUGUST</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_aug" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_aug" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>SEPTEMBER</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_sept" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_sept" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>OCTOBER</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_oct" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_oct" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>NOVEMBER</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_nov" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_nov" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>DECEMBER</td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_dec" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" form="store" name="is_dec" value="0" > 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">CLOSE</button>
                {{ html()->submit('SAVE FREQUENCY')->id('create_frequency_button')->class('btn btn-outline-success btn-block')->attribute('form','store')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Type-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold badge badge-primary" id="modalCreateLongTitle" style="font-size:16px;">FREQUENCY CREATION</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <input id="update_id" name='update_id' type="hidden" form="update">
                            {{ html()->label('FREQUENCY NAME:')->attribute('style','font-weight:bold;')->attribute('for','frequency_update') }}
                            {{ html()->text('frequency_update')->class('form-control')->id('frequency_update')->attribute('style','font-weight:bold;')->attribute('form','update') }}
                        </div>
                    </div>    
                    <div class="col-sm-6">
                        <table class="table">
                            <thead>
                                <th>MONTH</th>
                                <th class="text-center">YES</th>
                                <th class="text-center">NO</th>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td>JANUARY</td>
                                    <td class="text-center">
                                        <input id="is_jan_update_true" type="radio" form="update" name="is_jan_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_jan_update_false" type="radio" form="update" name="is_jan_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>FEBUARY</td>
                                    <td class="text-center">
                                        <input id="is_feb_update_true" type="radio" form="update" name="is_feb_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_feb_update_false" type="radio" form="update" name="is_feb_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>MARCH</td>
                                    <td class="text-center">
                                        <input id="is_mar_update_true" type="radio" form="update" name="is_mar_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_mar_update_false" type="radio" form="update" name="is_mar_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>APRIL</td>
                                    <td class="text-center">
                                        <input id="is_apr_update_true" type="radio" form="update" name="is_apr_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_apr_update_false" type="radio" form="update" name="is_apr_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>MAY</td>
                                    <td class="text-center">
                                        <input id="is_may_update_true" type="radio" form="update" name="is_may_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_may_update_false" type="radio" form="update" name="is_may_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>JUNE</td>
                                    <td class="text-center">
                                        <input id="is_jun_update_true" type="radio" form="update" name="is_jun_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_jun_update_false" type="radio" form="update" name="is_jun_update" value="0" > 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table">
                            <thead>
                                <th>MONTH</th>
                                <th class="text-center">YES</th>
                                <th class="text-center">NO</th>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td>JULY</td>
                                    <td class="text-center">
                                        <input id="is_jul_update_true" type="radio" form="update" name="is_jul_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_jul_update_false" type="radio" form="update" name="is_jul_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>AUGUST</td>
                                    <td class="text-center">
                                        <input id="is_aug_update_true" type="radio" form="update" name="is_aug_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_aug_update_false" type="radio" form="update" name="is_aug_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>SEPTEMBER</td>
                                    <td class="text-center">
                                        <input id="is_sept_update_true" type="radio" form="update" name="is_sept_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_sept_update_false" type="radio" form="update" name="is_sept_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>OCTOBER</td>
                                    <td class="text-center">
                                        <input id="is_oct_update_true" type="radio" form="update" name="is_oct_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_oct_update_false" type="radio" form="update" name="is_oct_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>NOVEMBER</td>
                                    <td class="text-center">
                                        <input id="is_nov_update_true" type="radio" form="update" name="is_nov_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_nov_update_false" type="radio" form="update" name="is_nov_update" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td>DECEMBER</td>
                                    <td class="text-center">
                                        <input id="is_dec_update_true" type="radio" form="update" name="is_dec_update" value="1" checked> 
                                    </td>
                                    <td class="text-center">
                                        <input id="is_dec_update_false" type="radio" form="update" name="is_dec_update" value="0" > 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">CLOSE</button>
                {{ html()->submit('UPDATE FREQUENCY')->id('create_frequency_button')->class('btn btn-outline-success btn-block')->attribute('form','update')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
            </div>
        </div>
    </div>
</div>

@include('includes.loading')
@endsection

@section('scripts')
    <script>
        function edit(id,frequency,jan,feb,mar,apr,may,jun,jul,aug,sept,oct,nov,dec){
            document.getElementById('update_id').value = id;
            document.getElementById('frequency_update').value = frequency;

            if(jan==0){
                document.getElementById("is_jan_update_false").checked = true;
                document.getElementById("is_jan_update_true").checked = false;
            }else{
                document.getElementById("is_jan_update_false").checked = false;
                document.getElementById("is_jan_update_true").checked = true;
            }

            if(feb==0){
                document.getElementById("is_feb_update_false").checked = true;
                document.getElementById("is_feb_update_true").checked = false;
            }else{
                document.getElementById("is_feb_update_false").checked = false;
                document.getElementById("is_feb_update_true").checked = true;
            }

            if(mar==0){
                document.getElementById("is_mar_update_false").checked = true;
                document.getElementById("is_mar_update_true").checked = false;
            }else{
                document.getElementById("is_mar_update_false").checked = false;
                document.getElementById("is_mar_update_true").checked = true;
            }

            if(apr==0){
                document.getElementById("is_apr_update_false").checked = true;
                document.getElementById("is_apr_update_true").checked = false;
            }else{
                document.getElementById("is_apr_update_false").checked = false;
                document.getElementById("is_apr_update_true").checked = true;
            }

            if(may==0){
                document.getElementById("is_may_update_false").checked = true;
                document.getElementById("is_may_update_true").checked = false;
            }else{
                document.getElementById("is_may_update_false").checked = false;
                document.getElementById("is_may_update_true").checked = true;
            }

            if(jun==0){
                document.getElementById("is_jun_update_false").checked = true;
                document.getElementById("is_jun_update_true").checked = false;
            }else{
                document.getElementById("is_jun_update_false").checked = false;
                document.getElementById("is_jun_update_true").checked = true;
            }

            if(jul==0){
                document.getElementById("is_jul_update_false").checked = true;
                document.getElementById("is_jul_update_true").checked = false;
            }else{
                document.getElementById("is_jul_update_false").checked = false;
                document.getElementById("is_jul_update_true").checked = true;
            }

            if(aug==0){
                document.getElementById("is_aug_update_false").checked = true;
                document.getElementById("is_aug_update_true").checked = false;
            }else{
                document.getElementById("is_aug_update_false").checked = false;
                document.getElementById("is_aug_update_true").checked = true;
            }

            if(sept==0){
                document.getElementById("is_sept_update_false").checked = true;
                document.getElementById("is_sept_update_true").checked = false;
            }else{
                document.getElementById("is_sept_update_false").checked = false;
                document.getElementById("is_sept_update_true").checked = true;
            }

            if(oct==0){
                document.getElementById("is_oct_update_false").checked = true;
                document.getElementById("is_oct_update_true").checked = false;
            }else{
                document.getElementById("is_oct_update_false").checked = false;
                document.getElementById("is_oct_update_true").checked = true;
            }

            if(nov==0){
                document.getElementById("is_nov_update_false").checked = true;
                document.getElementById("is_nov_update_true").checked = false;
            }else{
                document.getElementById("is_nov_update_false").checked = false;
                document.getElementById("is_nov_update_true").checked = true;
            }

            if(dec==0){
                document.getElementById("is_dec_update_false").checked = true;
                document.getElementById("is_dec_update_true").checked = false;
            }else{
                document.getElementById("is_dec_update_false").checked = false;
                document.getElementById("is_dec_update_true").checked = true;
            }
        }
    </script>
@endsection