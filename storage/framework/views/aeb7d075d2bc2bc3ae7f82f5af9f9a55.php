<?php $__env->startSection('main'); ?>



<div class="row">
                
<?php echo $__env->make('stock.message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-tools">
                        <a href="<?php echo e(route('product.create')); ?>">
                            <button type="button" class="btn btn-primary">
                                 Adicionar Novo
                            </button>
                            </a>
                        </div>
                        <div class="ibox-title">
                            <h5>Produtos(<?php echo e($data->total()); ?>) </h5>

                            <div class="row">
                            <div class="col-sm-6 rigth">
                                <form action="<?php echo e(route('product')); ?>" method="get">
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
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index->Cod_Product); ?></td>
                                        <td><?php echo e($index->Name_Product); ?></td>
                                        <td><?php echo e($index->Amount_Product); ?></td>
                                        <td><?php echo e($index->Min_Amount); ?></td>
                                        <td><?php echo e($index->Sale_Value); ?></td>

                                        <td>
                                            <form action="<?php echo e(route('product.edit')); ?>" method="get">
                                                <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($index->id); ?>">    
                                            <button type="submit"><i class="fa fa-pencil text-danger "></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    </tbody>

                                    
                                    
                                </table>
                                <?php if(request()->input('s')): ?>
                                    <?php echo e($data->appends(['s'=>request()->input('s')])->links()); ?>

                                <?php else: ?>
                                
                                    <?php echo e($data->links()); ?>

                                <?php endif; ?>
                        
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            

<?php $__env->stopSection(); ?>




<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/Rejanio/trampo/material-construcao/app/resources/views/stock/index.blade.php ENDPATH**/ ?>