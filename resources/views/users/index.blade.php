@extends('layouts.main')

@section('styles')
<style>
    .irene-table>:not(caption)>*>* {
        padding:0px !important;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title') 
    USER MODULE
@endsection 

@section('subtitle')
    List of Users
@endsection

@section('breadcrumbs_1')
    Users
@endsection

@section('breadcrumbs_2')
    List
@endsection

@section('button')
    <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalCreate">ADD USER</button> 
@endsection

@section('main')
{!! html()->modelForm(null, null)->class('form')->id('search')->attribute('action',route('users.index'))->attribute('method','GET')->open() !!}
{!! html()->closeModelForm() !!}

{!! html()->modelForm('POST', null)->class('form')->attribute('action',route('users.store'))->id('store')->acceptsFiles()->open() !!}
{!! html()->closeModelForm() !!} 

{!! html()->modelForm('POST', null)->class('form')->attribute('action',route('update_user'))->id('update')->acceptsFiles()->open() !!}
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
                    {{ html()->label('SEARCH:')->attribute('style','font-weight:bold;')->attribute('for','search_user') }}
                    {{ html()->text('search',$search)->placeholder('ENTER USER')->class('form-control ')->id('search_user')->attribute('style','font-weight:bold;')->attribute('form','search') }}
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
                            <th scope="col" style="width:10%; text-align:center;">ACTION</th>
                            <th scope="col" class="width:15%; text-center">PHOTO</th>
                            <th scope="col" class="width:10%; text-center">EMAIL</th>
                            <th scope="col" class="width:15%; text-center">NAME</th>
                            <th scope="col" style="width:10%; text-align:center;">ACTIVE</th>
                            <th scope="col" style="width:10%; text-align:center;">SUPERUSER</th>
                            <th scope="col" style="width:10%; text-align:center;">ADMIN</th>
                            <th scope="col" style="width:10%; text-align:center;">MAINTENANCE</th>
                            <th scope="col" style="width:10%; text-align:center;">IT</th>
                        </thead>
                        <tbody>
                            @if($users->isEmpty())
                            @else
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            <a onclick="edit('{!!$user->id!!}')" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                                <i class="mdi mdi-table-edit text-success"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($user->photo))
                                                <img style="width:100px; height:100px;" src="{{asset('user_images')}}/{{$user->photo}}" alt="">
                                            @else
                                                <img style="width:100px; height:100px;" src="{{asset('user_images/main.png')}}" alt="">
                                            @endif
                                        </td>
                                        <td class="text-center">{{$user->email}}</td>
                                        <td class="text-center">{{$user->name}}</td>
                                        <td class="text-center">
                                            @if($user->is_active == 1)
                                                <span class="badge bg-success">ACTIVE</span>
                                            @else
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($user->is_admin == 1)
                                                <span class="badge bg-success">ACTIVE</span>
                                            @else
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($user->is_admin_department == 1)
                                                <span class="badge bg-success">ACTIVE</span>
                                            @else:
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($user->is_maintenance == 1)
                                                <span class="badge bg-success">ACTIVE</span>
                                            @else
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($user->is_it == 1)
                                                <span class="badge bg-success">ACTIVE</span>
                                            @else
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$users->render()}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Type-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold badge badge-primary" id="modalCreateLongTitle" style="font-size:16px;">TYPE CREATION</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ html()->label('USER NAME:')->attribute('style','font-weight:bold;')->attribute('for','name') }}
                            {{ html()->text('name')->class('form-control')->id('name')->attribute('style','font-weight:bold;')->attribute('form','store') }}
                        </div>

                        <div class="form-group">
                            {{ html()->label('EMAIL:')->attribute('style','font-weight:bold;')->attribute('for','email') }}
                            {{ html()->email('email')->class('form-control')->id('email')->attribute('style','font-weight:bold;')->attribute('form','store') }}
                        </div>

                        <div class="form-group">
                            {{ html()->label('PASSWORD:')->attribute('style','font-weight:bold;')->attribute('for','password') }}
                            {{ html()->password('password')->class('form-control')->id('password')->attribute('style','font-weight:bold;')->attribute('form','store') }}
                        </div>

                        <div class="form-group">
                            {{ html()->label('DEPARTMENT:')->attribute('style','font-weight:bold;')->attribute('for','department_id') }}
                            {{ html()->select('department_id',$departments,null)->class('form-control')->id('department_id')->attribute('form','store') }}
                        </div>
                        <div class="form-group">
                            {{ html()->label('UPLOAD PICTURE:')->attribute('style','font-weight:bold;')->attribute('for','photo') }}
                            {{ html()->file('photo')->class('form-control')->id('photo')->attribute('style','font-weight:bold;')->attribute('form','store') }}
                        </div>
                    </div>    
                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <table class="table irene-table">
                                <thead class="text-center">
                                    <tr>
                                        <th style="border-color: transparent;"></th>
                                        <th style="border-color: transparent;">YES</th>
                                        <th style="border-color: transparent;">NO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="irene-tr">
                                        <td colspan="3"><br></td>
                                    </tr>
                                    <tr class="irene-tr">
                                        <td>SUPER USER</td>
                                        <td class="text-center"><input type="radio" form="store" name="is_admin" value="1" checked></td>
                                        <td class="text-center"><input type="radio" form="store" name="is_admin" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS ACTIVE</td>
                                        <td class="text-center"><input type="radio" form="store" name="is_active" value="1" checked></td>
                                        <td class="text-center"><input type="radio" form="store" name="is_active" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS ADMIN</td>
                                        <td class="text-center"><input type="radio" form="store" name="is_admin_department" value="1" checked></td>
                                        <td class="text-center"><input type="radio" form="store" name="is_admin_department" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS MAINTENANCE</td>
                                        <td class="text-center"><input type="radio" form="store" name="is_maintenance" value="1" checked></td>
                                        <td class="text-center"><input type="radio" form="store" name="is_maintenance" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS IT</td>
                                        <td class="text-center"><input type="radio" form="store" name="is_it" value="1" checked></td>
                                        <td class="text-center"><input type="radio" form="store" name="is_it" value="0"></td>
                                    </tr>
                                    @foreach ($companies as $company)
                                        <tr class="irene-tr">
                                            <td>{{$company->company_name}}</td>
                                            <td class="text-center">
                                                <input type="radio" form="store" name="company[{!!$company->company_name!!}]" value="1">
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" form="store" name="company[{!!$company->company_name!!}]" value="0" checked>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">CLOSE</button>
                {{ html()->submit('SAVE USER')->id('create_type_button')->class('btn btn-outline-success btn-block')->attribute('form','store')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Type-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold badge badge-primary" id="modalEditLongTitle" style="font-size:16px;">TYPE UPDATE</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ html()->hidden('update_id')->attribute('form','update')->attribute('id','update_id') }}
                            {{ html()->hidden('photo_update_check')->attribute('form','update')->attribute('id','photo_update_check') }}
                            {{ html()->label('NAME:')->attribute('style','font-weight:bold;')->attribute('for','user_name_update') }}
                            {{ html()->text('user_name_update')->class('form-control')->id('user_name_update')->attribute('style','font-weight:bold;')->attribute('form','update') }}
                        </div>
                        <div class="form-group">
                            {{ html()->label('EMAIL:')->attribute('style','font-weight:bold;')->attribute('for','email_update') }}
                            {{ html()->text('email_update')->class('form-control')->id('email_update')->attribute('form','update') }}
                        </div>
                        <div class="form-group">
                            {{ html()->label('PASSWORD:')->attribute('style','font-weight:bold;')->attribute('for','password_update') }}
                            {{ html()->password('password_update')->class('form-control')->id('password_update')->attribute('style','font-weight:bold;')->attribute('form','store') }}
                        </div>
                        <div class="form-group">
                            {{ html()->label('DEPARTMENT:')->attribute('style','font-weight:bold;')->attribute('for','department_id_update') }}
                            {{ html()->select('department_id_update',$departments,null)->class('form-control')->id('department_id_update')->attribute('form','update') }}
                        </div>
                        <div class="form-group">
                            {{ html()->label('UPLOAD NEW PICTURE:')->attribute('style','font-weight:bold;')->attribute('for','photo_update') }}
                            {{ html()->file('photo_update')->class('form-control')->id('photo')->attribute('style','font-weight:bold;')->attribute('form','update') }}
                        </div>
                    </div>    

                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <table class="table irene-table">
                                <thead class="text-center">
                                    <tr>
                                        <th style="border-color: transparent;"></th>
                                        <th style="border-color: transparent;">YES</th>
                                        <th style="border-color: transparent;">NO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="irene-tr">
                                        <td colspan="3"><br></td>
                                    </tr>
                                    <tr class="irene-tr">
                                        <td>SUPER USER</td>
                                        <td class="text-center"><input id="super_user_true" type="radio" form="update" name="is_admin_update" value="1" checked></td>
                                        <td class="text-center"><input id="super_user_false" type="radio" form="update" name="is_admin_update" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS ACTIVE</td>
                                        <td class="text-center"><input id="is_active_true" type="radio" form="update" name="is_active_update" value="1" checked></td>
                                        <td class="text-center"><input id="is_active_false" type="radio" form="update" name="is_active_update" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS ADMIN</td>
                                        <td class="text-center"><input id="is_admin_true" type="radio" form="update" name="is_admin_department_update" value="1" checked></td>
                                        <td class="text-center"><input id="is_admin_false" type="radio" form="update" name="is_admin_department_update" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS MAINTENANCE</td>
                                        <td class="text-center"><input id="is_maintenance_true" type="radio" form="update" name="is_maintenance_update" value="1" checked></td>
                                        <td class="text-center"><input id="is_maintenance_false" type="radio" form="update" name="is_maintenance_update" value="0"></td>
                                    </tr>

                                    <tr class="irene-tr">
                                        <td>IS IT</td>
                                        <td class="text-center"><input type="radio" id="is_it_true" form="update" name="is_it_update" value="1" checked></td>
                                        <td class="text-center"><input type="radio" id="is_it_false" form="update" name="is_it_update" value="0"></td>
                                    </tr>
                                    @foreach ($companies as $company)
                                        <tr class="irene-tr">
                                            <td>{{$company->company_name}}</td>
                                            <td class="text-center">
                                                <input id="{!!$company->company_name!!}_true" type="radio" form="update" name="company_update[{!!$company->company_name!!}]" value="1">
                                            </td>
                                            <td class="text-center">
                                                <input id="{!!$company->company_name!!}_false" type="radio" form="update" name="company_update[{!!$company->company_name!!}]" value="0" checked>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">CLOSE</button>
                {{ html()->submit('UPDATE')->id('create_type_button')->class('btn btn-outline-success btn-block')->attribute('form','update')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
            </div>
        </div>
    </div>
</div>

@include('includes.loading')
@endsection

@section('scripts')
    <script>
        function edit(id){
            let user_id = id;
            $('#modalManual2').modal('show');
            $.ajax({
                type:"GET",//or POST
                url:'{{url("/get_user/")}}'+'/'+user_id,
                
                success:function(responsedata){
                    document.getElementById('update_id').value = responsedata.data.id;
                    document.getElementById('user_name_update').value = responsedata.data.name;
                    document.getElementById('email_update').value = responsedata.data.email;
                    document.getElementById('department_id_update').value = responsedata.data.department_id;
                    document.getElementById('photo_update_check').value = responsedata.data.photo;
                    
                    if(responsedata.data.is_active == 1){
                        document.getElementById('is_active_true').checked = true;
                        document.getElementById('is_active_false').checked = false;
                    }else{
                        document.getElementById('is_active_true').checked = false;
                        document.getElementById('is_active_false').checked = true;
                    }

                    if(responsedata.data.is_admin == 1){
                        document.getElementById('super_user_true').checked = true;
                        document.getElementById('super_user_false').checked = false;
                    }else{
                        document.getElementById('super_user_true').checked = false;
                        document.getElementById('super_user_false').checked = true;
                    }

                    if(responsedata.data.is_maintenance == 1){
                        document.getElementById('is_maintenance_true').checked = true;
                        document.getElementById('is_maintenance_false').checked = false;
                    }else{
                        document.getElementById('is_maintenance_true').checked = false;
                        document.getElementById('is_maintenance_false').checked = true;
                    }

                    if(responsedata.data.is_admin_department == 1){
                        document.getElementById('is_admin_true').checked = true;
                        document.getElementById('is_admin_false').checked = false;
                    }else{
                        document.getElementById('is_admin_true').checked = false;
                        document.getElementById('is_admin_false').checked = true;
                    }

                    if(responsedata.data.is_maintenance == 1){
                        document.getElementById('is_maintenance_true').checked = true;
                        document.getElementById('is_maintenance_false').checked = false;
                    }else{
                        document.getElementById('is_maintenance_true').checked = false;
                        document.getElementById('is_maintenance_false').checked = true;
                    }

                    if(responsedata.data.is_it == 1){
                        document.getElementById('is_it_true').checked = true;
                        document.getElementById('is_it_false').checked = false;
                    }else{
                        document.getElementById('is_it_true').checked = false;
                        document.getElementById('is_it_false').checked = true;
                    }

                    
                }   
            });

            setTimeout(function() { 
                $.ajax({
                    type:"GET",//or POST
                    url:'{{url("/all_company/")}}',
                    success:function(companies_two){
                        companies_two.data.forEach(function(data2, index) {
                            document.getElementById(data2.company_name+'_true').checked = false;
                            document.getElementById(data2.company_name+'_false').checked = true;
                        });
                    }
                });
            }, 1500);

            setTimeout(function() { 
                $.ajax({
                    type:"GET",//or POST
                    url:'{{url("/get_user_company/")}}'+'/'+user_id,
                    success:function(companies){
                        companies.data.forEach(function(data, index) {
                            document.getElementById(data.company_name+'_true').checked = true;
                            document.getElementById(data.company_name+'_false').checked = false;
                        });

                        setTimeout(function() { 
                            $('#modalManual2').modal('hide');
                        }, 2500);
                    }
                });
            }, 2000);
        }
    </script>
@endsection