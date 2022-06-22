<?php

return [
    'structured_data' => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'handler' => \BehaviorLab\StructDataFieldType\Support\Config\StructuredDataHandler::class,
        ],
    ],
    'min'    => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
    'max'    => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
        ],
    ],
];
