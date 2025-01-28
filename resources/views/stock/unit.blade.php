@extends('master')
@section('main')



<div class="row">
                
                            <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="{{route('unit')}}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Nova Unidade</h4>
                                        </div>
                                        <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for=""class="col-sm-1 control-label" >Nome</label>
                                                        <input type="text" class="form-control col-sm-10" name="name" maxlength="20">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for=""class="col-sm-1 control-label" >Abreviação</label>
                                                        <input type="text" class="form-control" name="shortname" maxlength="3">
                                                    </div>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                            </div>


                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Unidades </h5>
                            <div class="ibox-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal6">
                                    Adicionar Novo
                                </button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Abreviação </th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $index)
                                    <tr>
                                        <td>{{$index->Name_Unit_Type}}</td>
                                        <td>{{$index->Short_Name}}</td>
                                        <td><a href="{{route('unit.destroy',$index->id) }}"><i class="fa fa-times text-danger demo3"></i></a></td>
                                    </tr>
                                    @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            

@endsection
