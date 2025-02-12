@extends('master')
@section('main')
<div class="row">
    @include('stock.message')
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Cadastro de cliente.</h5>
                
            </div>
            <div class="ibox-content">
                <form method="post" action="{{route('client.store')}}" class="form-horizontal">
                    @csrf
                    <p>Dados Pessoais.</p>

                    <div class="form-group">
                        <label class="col-sm-6">Nome*
                            <input type="text" name="name"  maxlength="11" class="form-control" required>
                            
                        </label>
                        <label class="col-sm-6">Sobrenome*
                            <input type="text" name="last-name"  maxlength="40" class="form-control" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6">CPF
                            <input type="text" name="cpf"  maxlength="11" pattern="\d+" class="form-control" >
                            
                        </label>
                        <label class="col-sm-6">Whatsapp*
                            <input type="text" name="whatsapp" id="celljr" maxlength="15"   class="form-control" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Email
                            <input type="email" name="email"   class="form-control" >
                            
                        </label>
                    </div>

                    <div class="hr-line-dashed"></div>
                   

                    <div class="form-group">
                        <div class="col-sm-4 ">
                            <button class="btn btn-primary " type="submit">Salvar</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
@endsection
