@extends('master-2')
@section('main')
<div class="row">

    <div class="col-lg-12">
        
        <div class="ibox float-e-margins">
            
            <div class="ibox-title">
                <h5>Caixa</h5>
            </div>

            <div class="ibox-content">
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nota</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $index)
                        <tr>
                            <td>{{$index->Date_Cash_Book}}</td>
                            <td>{{$index->Note_Cash_Book}}</td>
                            <td>{{($index->Type_Cash_Book == 0)? "Saída" : "Entrada"  }}</td>
                            <td>{{$index->Value_Cash_Book}}</td>
                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="ibox-content">
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        
                        <tbody>
                        <tr>
                            <th>Fluxo</th>
                            <td>{{$report[0]}}</td>
                        </tr>
                        <tr>
                            <th>Saldo Anterior</th>
                            <td>{{$report[1]}}</td>
                        </tr>
                        <tr>
                            <th>Receita</th>
                            <td>{{$report[2]}}</td>
                        </tr>
                        <tr>
                            <th>Despesa</th>
                            <td>{{$report[3]}}</td>
                        </tr>
                        <tr>
                            <th>Saldo</th>
                            <td>{{$report[4]}}</td>
                        </tr>
                        <tr>
                            <th>Subtotal</th>
                            <td>{{$report[5]}}</td>
                        </tr>
                        
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
