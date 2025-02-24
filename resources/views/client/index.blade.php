@extends('master-2')
@section('main')
<div class="row">
                
                @include('stock.message')
                
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools">
                                        <a href="{{route('client.create')}}">
                                            <button type="button" class="btn btn-primary">
                                                 Adicionar Novo
                                            </button>
                                            </a>
                                        </div>
                                        <div class="ibox-title">
                                            <h5>Clientes (XXX) </h5>
                
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
                                                        <th>Nome Completo</th>
                                                        <th>Cpf</th>
                                                        <th>Whatsapp</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    <tr>
                                                        <td>Nome Exemplo</td>
                                                        <td>999.999.999-99</td>
                                                        <td>(99)99999-9999</td>
                                                        
                                                        <td>
                                                            <form action="#" method="get">
                                                                @csrf
                                                            <input type="hidden" name="id" value="#">    
                                                            <button type="submit">Painel</button>
                                                            </form>
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    </tbody>
                
                                                    
                                                    
                                                </table>
                                                @if (request()->input('s'))
                                                    {{$client->appends(['s'=>request()->input('s')])->links()}}
                                                @else
                                                
                                                    {{$client->links()}}
                                                @endif
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                
@endsection