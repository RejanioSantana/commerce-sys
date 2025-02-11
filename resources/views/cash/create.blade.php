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
                <div class="col-sm-10"><input type="text" name="note" maxlength="25" class="form-control" required></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-10">
                    <label>Mês</label>
                      <select class="form-control" name="month" required >
                        <?php 
                            $currentMonth = date('n'); // Obtém o número do mês atual (1-12)
                            $months = [
                                1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 
                                6 => 'Jun', 7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 
                                11 => 'Nov', 12 => 'Dez'
                            ];

                            foreach ($months as $value => $name) {
                                $selected = ($value == $currentMonth) ? 'selected' : ''; // Verifica se é o mês atual
                                echo "<option value=\"$value\" $selected>$name</option>";
                            }
                        ?>
                      </select>
                
                </label>
                <label>
                    <label for="exampleInputEmail1">Ano</label>
                    <input type="text" class="form-control" name="year" id="exampleInputEmail1" 
                    value="{{date("Y",time())}}" pattern="^\d{4,}$"
                    size="4" maxlength="4" required>
                
                </label>
            
            </div>
            <div class="hr-line-dashed"></div>


            <div class="form-group"><label class="col-sm-2 control-label">Valor*</label>
                <div class="col-sm-10">
                <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" name="value" pattern="^[0-9]+(\.[0-9]+)?$" placeholder="0000.00" maxlength="11" class="form-control" required></div>
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
