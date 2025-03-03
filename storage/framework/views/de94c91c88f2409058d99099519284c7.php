<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo e($title); ?></title>

    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">


    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('assets/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

    <script>
        function sCode(){

            let termo = document.getElementById("codB").value;
            let ncmP = document.getElementById("ncm-p");
            let nameP = document.getElementById("name-p");
            let loading = document.getElementById("loadp");

            loading.style.display = "block";
                
            // Gerar a URL da rota 'sale.index' com o termo de pesquisa como parâmetro de consulta
            const url = "<?php echo e(route('product.scode')); ?>";

            // Enviar a requisição GET para a rota 'sale.index'
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' // Adicionar o token CSRF para segurança
                },
                body: JSON.stringify({termo: termo}),
            })
            .then(response => {
                if (!response.ok) {
                    alert('Item não encontrado.')
                }
                return response.json();
            })
            .then(data => {
              
                nameP.value = data.dados.description;
                ncmP.value = data.dados.ncm.code;                    
                
                })
            .catch(error => alert('Sem resultado da pesquisa.'))
            .finally(() => {
                // Oculta o loading após o término da requisição
                loading.style.display = "none";
                }); 
                
        }
        
    </script>

</head>

<body class="fixed-navigation" >
    <div id="wrapper" >
    <nav class="navbar-default navbar-static-side" role="navigation">
        <?php echo $__env->make('partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </nav>

        <div id="page-wrapper" class="gray-bg sidebar-content" >
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </nav>
        </div>
            <!-- <div class="sidebard-panel">
                <?php echo $__env->make('partials.sidebard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div> -->
            <div class="wrapper wrapper-content" >
                <?php echo $__env->yieldContent('main'); ?>
            </div>
        <div class="footer">
            <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        </div>
        <div id="right-sidebar">
            <?php echo $__env->make('partials.right-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <!-- Mainly scripts -->

    <script src="<?php echo e(asset('assets/js/jquery-2.1.1.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>

    <!-- Flot -->
    <script src="<?php echo e(asset('assets/js/plugins/flot/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/flot/jquery.flot.tooltip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/flot/jquery.flot.spline.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/flot/jquery.flot.resize.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/flot/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/flot/jquery.flot.symbol.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/flot/curvedLines.js')); ?>"></script>

    <!-- Peity -->
    <script src="<?php echo e(asset('assets/js/plugins/peity/jquery.peity.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/demo/peity-demo.js')); ?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo e(asset('assets/js/inspinia.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/pace/pace.min.js')); ?>"></script>

    <!-- jQuery UI -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>

    <!-- Jvectormap -->
    <script src="<?php echo e(asset('assets/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>

    <!-- Sparkline -->
    <script src="<?php echo e(asset('assets/js/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo e(asset('assets/js/demo/sparkline-demo.js')); ?>"></script>

    <!-- ChartJS-->
    <script src="<?php echo e(asset('assets/js/plugins/chartJs/Chart.min.js')); ?>"></script>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('assets/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('.demo3').click(function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "Example dataset",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.7)",
                        pointColor: "rgba(26,179,148,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions);


        });
    </script>

    <script>
            document.getElementById('celljr').addEventListener('input', function (e) {
                let numero = e.target.value.replace(/\D/g, ''); // Remove tudo que não for número
                let formato = '';

                if (numero.length > 10) {
                    formato = `(${numero.slice(0, 2)})${numero.slice(2, 7)}-${numero.slice(7, 11)}`;
                } else if (numero.length > 6) {
                    formato = `(${numero.slice(0, 2)})${numero.slice(2, 6)}-${numero.slice(6, 10)}`;
                } else if (numero.length > 2) {
                    formato = `(${numero.slice(0, 2)})${numero.slice(2)}`;
                } else if (numero.length > 0) {
                    formato = `(${numero}`;
                }

                e.target.value = formato;
            });
        </script>
    
</body>
</html>
<?php /**PATH /home/Rejanio/trampo/material-construcao/app/resources/views/master.blade.php ENDPATH**/ ?>