<?php

return [

    'pdf' => [
        'enabled' => true,
        'binary'  => env('WKHTMLTOPDF_PATH', 'C:/wkhtmltopdf/bin/wkhtmltopdf.exe'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],

];
