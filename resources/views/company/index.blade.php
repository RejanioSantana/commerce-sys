@extends('master')
@section('main')

<div class="row" >
    @include('stock.message')
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Empresa<small> Dados do comercio.</small></h5>
                            
                        </div>
            <div class="ibox-content" >
            <form role="form" class="form-horizontal" name="formulario" method="post" action="{{ route('company.store') }}">
            @csrf
            
            <div class="form-group">
                <label class="col-sm-6">
                    <label>Nome Comercial</label>
                    <input type="text" name="name" class="form-control" value="{{ $data->Name_Company }}">
                
                </label>
                <label class="col-sm-6">
                    <label>Nome Fantasia</label>
                    <input type="text" name="name_fantasy" class="form-control" value="{{ $data->Name_Fantasy }}">
                </label>
            
            </div>

            <div class="hr-line-dashed"></div>


            <div class="form-group">
                <label class="col-sm-6">
                    <label>CNPJ</label>
                    <input type="text" name="cnpj" class="form-control" value="{{ $data->Cnpj}}">
                
                </label>
                <label class="col-sm-6">
                    <label>Telefone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $data->Phone }}">
                </label>
            
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-6">
                    <label>IE</label>
                    <input type="text" name="ie" class="form-control" value="{{ $data->IE }}">
                
                </label>
                <label class="col-sm-6">
                    <label>ICMS</label>
                    <div>
                        <div class="input-group m-b"><span class="input-group-addon">%</span> <input type="text" name="icms" value="{{ $data->ICMS}}" pattern="^[0-9]+(\.[0-9]+)?$"  maxlength="6" class="form-control" required></div>
                    </div>
                </label>
            
            </div>
            <!--  -->

            <div class="ibox float-e-margins">
                        
                        <div class="ibox-content">
                            <h4>
                                Emitir Nota Fiscal (NFCE)?
                            </h4>
                            <p>
                                Se ativado esta opção, o sistema tentará Emitir nfc-e através do SEFAZ-Ba.
                            </p>
                            <div class="switch">
                                <div class="onoffswitch">
                                    @if($data->Nfe == 1)
                                        <input type="checkbox" name="nfce" checked class="onoffswitch-checkbox" id="example1">
                                        @else
                                        <input type="checkbox" name="nfce" class="onoffswitch-checkbox" id="example1">
                                    @endif
                                    <label class="onoffswitch-label" for="example1">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                           

                        </div>
                    </div>

            <!--  -->
            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <div class="col-sm-4">
                    <button class="btn btn-primary" type="submit">Atualizar</button>
                </div>
            </div>

            </form>

            </div>
        </div>
    </div>
</div>

@endsection
