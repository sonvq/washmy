<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'api-create-reporting' => [
        'rules' => [
            'report_content' => 'required|max:255',
            'customer_id' => 'exists:customer__customers,id',
            'washer_id' => 'exists:washer__washers,id',
            'washrequest_id' => 'exists:washrequest__washrequests,id'
        ],
        'messages' => [
            
        ]
    ],
  
];
