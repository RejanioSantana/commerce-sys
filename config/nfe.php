<?php
return [
    'certificado' => [
        'arquivo' => storage_path('certificados/certificado.pfx'),
        'senha'   => env('NFCE_CERT_PASSWORD'),
    ],
    'ambiente' => 1, // 1 = Produção, 2 = Homologação
];