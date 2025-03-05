@extends('master')
@section('main')

<div class="row">
    @include('stock.message')
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Lançamento<small>, Aqui você pode lançar receita/despesa no seu caixa atual.</small></h5>
                            
                        </div>
            <div class="ibox-content">
            <form role="form" class="form-horizontal" name="formulario" method="post" action="{{route('cash.store')}}">
            @csrf
            <div class="form-group">
                <label class="col-sm-12">Tipo de Lançamento*</label>
                <label class="col-sm-5">

                    <input type="radio" name="type" value="1" required>
                    <label for="description">Receita</label>
    
                </label>
                <label class="col-sm-5">
                    <input type="radio" name="type"  value="0" >
                    <label for="description">Despesa</label>
                
                </label>
                
            </div>

            <div class="hr-line-dashed"></div>


            <div class="form-group">
                <label class="col-sm-2 control-label">Descrição*</label>
                <div class="col-sm-10"><input type="text" name="note" maxlength="25" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off"  required></div>
            </div>
            <div class="hr-line-dashed"></div>

            
            <div class="hr-line-dashed"></div>


            <div class="form-group"><label class="col-sm-2 control-label">Valor*</label>
                <div class="col-sm-10">
                <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" name="value" pattern="^[0-9]+(\.[0-9]+)?$" placeholder="0000.00" maxlength="11" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off"  required></div>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="submit">Salvar</button>
                                    </div>
                                </div>
        </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection
