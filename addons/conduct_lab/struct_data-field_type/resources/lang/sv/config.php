<?php

return [
    'related' => [
        'label'        => 'StructuredDatas',
        'instructions' => 'Ange de relaterade <a href="' . url(
                'admin/structured_datas'
            ) . '" target="_blank">structured_datasen</a>.',
    ],
    'min'     => [
        'label'        => 'Minsta antal',
        'instructions' => 'Ange minst antal tillåtna element.',
    ],
    'max'     => [
        'label'        => 'Störst antal',
        'instructions' => 'Ange störst antal tillåtna element.',
    ],
];
