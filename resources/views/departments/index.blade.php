@extends('layouts.main')

@section('styles')
@endsection

@section('title') 
    DEPARTMENT MODULES
@endsection 

@section('subtitle')
    List of Department
@endsection

@section('breadcrumbs_1')
    Departments
@endsection

@section('breadcrumbs_2')
    List
@endsection

@section('button')
    <button class="btn btn-primary mt-2 mt-xl-0" data-bs-toggle="modal" data-bs-target="#modalCreate">ADD DEPARTMENT</button> 
@endsection

@section('main')
{!! html()->modelForm(null, null)->class('form')->id('search')->attribute('action',route('departments.index'))->attribute('method','GET')->open() !!}
{!! html()->closeModelForm() !!}

{!! html()->modelForm('POST', null)->class('form')->attribute('action',route('departments.store'))->id('store')->acceptsFiles()->open() !!}
{!! html()->closeModelForm() !!} 

{!! html()->modelForm('POST', null)->class('form')->attribute('action',route('update_department'))->id('update')->acceptsFiles()->open() !!}
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
                    {{ html()->label('SEARCH:')->attribute('style','font-weight:bold;')->attribute('for','search') }}
                    {{ html()->text('search',$search)->placeholder('ENTER DEPARTMENT')->class('form-control ')->id('search')->attribute('style','font-weight:bold;')->attribute('form','search') }}
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
                            <th class="text-center">DEPARTMENT NAME</th>
                            <th class="text-center">ACTION</th>
                        </thead>
                        <tbody>
                            @if($departments->isEmpty())
                            @else
                                @foreach ($departments as $department)
                                    <tr>
                                        <td class="text-center">{{$department->department_name}}</td>
                                        <td class="text-center">
                                            <a onclick="edit('{!!$department->id!!}','{!!$department->department_name!!}')" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                                <i class="mdi mdi-table-edit text-success"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$departments->render()}}
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
                <h5 class="modal-title font-weight-bold badge badge-primary" id="modalCreateLongTitle" style="font-size:16px;">DEPARTMENT CREATION</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            {{ html()->label('DEPARTMENT NAME:')->attribute('style','font-weight:bold;')->attribute('for','department_name') }}
                            {{ html()->text('department_name')->class('form-control')->id('department_name')->attribute('style','font-weight:bold;')->attribute('form','store') }}
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">CLOSE</button>
                {{ html()->submit('SAVE DEPARTMENT')->id('create_type_button')->class('btn btn-outline-success btn-block')->attribute('form','store')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Type-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold badge badge-primary" id="modalEditLongTitle" style="font-size:16px;">DEPARTMENT UPDATE</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            {{ html()->hidden('update_id')->attribute('form','update')->attribute('id','update_id') }}
                            {{ html()->label('DEPARTMENT NAME:')->attribute('style','font-weight:bold;')->attribute('for','department_name_update') }}
                            {{ html()->text('department_name_update')->class('form-control')->id('department_name_update')->attribute('style','font-weight:bold;')->attribute('form','update') }}
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">CLOSE</button>
                {{ html()->submit('UPDATE DEPARTMENT')->id('create_type_button')->class('btn btn-outline-success btn-block')->attribute('form','update')->attribute('data-bs-toggle','modal')->attribute('data-bs-target','#modalManual2') }}
            </div>
        </div>
    </div>
</div>

@include('includes.loading')
@endsection

@section('scripts')
    <script>
        function edit(id,department_name){
            document.getElementById('update_id').value = id;
            document.getElementById('department_name_update').value = department_name;
        }
    </script>
@endsection