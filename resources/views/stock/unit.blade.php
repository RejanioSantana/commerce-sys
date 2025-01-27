@extends('master')
@section('main')



<div class="row">
                
                            <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="#" method="post" class="form-horizontal">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Nova Unidade</h4>
                                        </div>
                                        <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for=""class="col-sm-1 control-label" >Nome</label>
                                                        <input type="text" class="form-control col-sm-10" maxlength="20">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for=""class="col-sm-1 control-label" >Abreviação</label>
                                                        <input type="text" class="form-control" maxlength="3">
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
                                    <tr>
                                        <td>Project<small>This is example of project</small></td>
                                        <td><span class="pie">0.52/1.561</span></td>
                                        <td><a href="#"><i class="fa fa-times text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                       <td>Alpha project</td>
                                        <td><span class="pie">6,9</span></td>
                                        <td><a href="#"><i class="fa fa-times text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                       <td>Betha project</td>
                                        <td><span class="pie">3,1</span></td>
                                        <td><a href="#"><i class="fa fa-times text-danger"></i></a></td>
                                    </tr>
                                    <tr>
                                       <td>Gamma project</td>
                                        <td><span class="pie">4,9</span></td>
                                        <td><a href="#"><i class="fa fa-times text-danger"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

@endsection
