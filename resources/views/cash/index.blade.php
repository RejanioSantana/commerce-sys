@extends('master')
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
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cash as $index)
                        <tr>
                            <td>{{$index->Cash_Date}}</td>
                            <td>{{($index->Cash_Date == date('Y-m-01'))? "Aberto" : "Fechado"  }}</td>
                            <td><a href="{{route('cash.show',$index->id) }}"><button type="button" class="btn btn-primary btn-sm">Extrato</button></a></td>
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
