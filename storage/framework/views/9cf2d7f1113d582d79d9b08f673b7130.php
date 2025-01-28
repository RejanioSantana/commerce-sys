]
<?php $__env->startSection('main'); ?>
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Adicionar Produto<small> Cadastre novos produtos no estoque.</small></h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form method="get" class="form-horizontal">


                                <div class="form-group"><label class="col-sm-2 control-label">Codigo</label>

                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Nome</label>

                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Quantidade</label>

                                    <div class="col-sm-10"><input type="number" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Mínimo no Estoque</label>

                                    <div class="col-sm-10"><input type="number" class="form-control"></div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Valor de Compra</label>

                                    <div class="col-sm-10">
                                       <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Valor de Venda</label>

                                    <div class="col-sm-10">
                                       <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" class="form-control"></div>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Nota</label>

                                    <div class="col-sm-10"><textarea name="note" class="form-control"></textarea></div>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/Rejanio/trampo/material-construcao/app/resources/views/product/index.blade.php ENDPATH**/ ?>