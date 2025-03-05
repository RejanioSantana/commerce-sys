@extends('master')
@section('main')



<div class="row">
                
@include('stock.message')

                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-tools">
                        <a href="{{route('product.create')}}">
                            <button type="button" class="btn btn-primary">
                                 Adicionar Novo
                            </button>
                            </a>
                        </div>
                        <div class="ibox-title">
                            <h5>Produtos({{$data->total()}}) </h5>

                            <div class="row">
                            <div class="col-sm-6 rigth">
                                <form action="{{route('product')}}" method="get">
                                    <div class="input-group"><input type="text" name="s" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="submmit" class="btn btn-sm btn-primary"> Go!</button> </span></div>

                                </form>
                                </div>
                            </div>
                           
                        </div>
                        <div class="ibox-content">
                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Nome</th>
                                        <th>Quant</th>
                                        <th>Min-Quant</th>
                                        <th>Valor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $index)
                                    <tr>
                                        <td>{{$index->Cod_Product}}</td>
                                        <td>{{$index->Name_Product}}</td>
                                        <td>{{$index->Amount_Product}}</td>
                                        <td>{{$index->Min_Amount}}</td>
                                        <td>{{$index->Sale_Value}}</td>

                                        <td>
                                            <form action="{{route('product.edit') }}" method="get">
                                                @csrf
                                            <input type="hidden" name="id" value="{{$index->id}}">    
                                            <button type="submit"><i class="fa fa-pencil text-danger "></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    </tbody>

                                    
                                    
                                </table>
                                @if (request()->input('s'))
                                    {{$data->appends(['s'=>request()->input('s')])->links()}}
                                @else
                                
                                    {{$data->links()}}
                                @endif
                        
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            

@endsection



