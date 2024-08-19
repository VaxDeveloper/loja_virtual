<?php
require_once 'vendor/autoload.php';

use Gerencianet\Gerencianet;

$options = [
    'client_id' => 'seu_client_id',
    'client_secret' => 'seu_client_secret',
    'pix_cert' => 'caminho_do_certificado.pem',
    'sandbox' => true // false para produção
];

$gn = new Gerencianet($options);

$body = [
    'calendario' => ['expiracao' => 3600],
    'devedor' => [
        'cpf' => '00000000000',
        'nome' => 'Nome do Cliente'
    ],
    'valor' => ['original' => '100.00'],
    'chave' => 'sua_chave_pix',
    'infoAdicionais' => [
        ['nome' => 'Observação', 'valor' => 'Compra na Loja Virtual']
    ]
];

$pix = $gn->pixCreateImmediateCharge([], $body);

$qrcode = $pix['loc']['qrcode'];
echo "<img src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={$qrcode}' alt='QR Code'>";
?>