
    <?php if(session()->has('success')): ?>

        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?php echo e(session('success')); ?>

        </div>
    

    <?php endif; ?>

        <?php if(session()->has('flash')): ?>

            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo e(session('flash')); ?>

            </div>
        
        <?php endif; ?>
        
        <?php if(session()->has('error')): ?>

            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo e(session('error')); ?>

            </div>
            
        <?php endif; ?>
<?php /**PATH /home/Rejanio/trampo/material-construcao/app/resources/views/stock/message.blade.php ENDPATH**/ ?>