@extends('master')
@section('main')
<div class="row">
    
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Atualização de Produto<small>.</small></h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{route('product.update')}}" class="form-horizontal">
                                @csrf

                                <div class="form-group"><label class="col-sm-2 control-label">Codigo*</label>

                                    <div class="col-sm-10"><input type="hidden" name="cod" value="{{$data->Cod_Product}}" pattern="\d+" maxlength="20" class="form-control" ></div>
                                    <div class="col-sm-10"><input type="text" value="{{$data->Cod_Product}}" pattern="\d+" maxlength="20" class="form-control" disabled></div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Nome*</label>

                                    <div class="col-sm-10"><input type="text" name="name" value="{{$data->Name_Product}}" maxlength="50" class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Quantidade*</label>

                                    <div class="col-sm-10"><input type="number" name="amount" value="{{$data->Amount_Product}}" pattern="\d+" class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Quantidade Mínima*</label>

                                    <div class="col-sm-10"><input type="number" name="min-amount" value="{{$data->Min_Amount}}" pattern="\d+" class="form-control" required></div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Valor de Compra*</label>

                                    <div class="col-sm-10">
                                       <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" value="{{$data->Purchase_Value}}" name="pucharse-value" pattern="^[0-9]+(\.[0-9]+)?$" placeholder="0000.00" maxlength="11" class="form-control" required></div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Valor de Venda*</label>

                                    <div class="col-sm-10">
                                       <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" name="sale-value" value="{{$data->Sale_Value}}" pattern="^[0-9]+(\.[0-9]+)?$" placeholder="0000.00" maxlength="11" class="form-control" required></div>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Unidade*</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="unit" required>
                                        <option value="">Selecione...</option>
                                        @foreach ($unit as $index)
                                        <option value="{{$index->id}}">{{$index->Short_Name}}</option>
                                        
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Categoria*</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="category" required>
                                        <option value="">Selecione...</option>
                                        @foreach ($category as $index)
                                        <option value="{{$index->id}}">{{$index->Name_Product_Category}}</option>
                                        
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Nota</label>

                                    <div class="col-sm-10"><textarea name="note" value="{{$data->Note_Product}}" maxlength="255" class="form-control"></textarea></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="submit">Salvar</button>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection
