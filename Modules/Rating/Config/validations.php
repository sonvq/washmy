<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'api-create-rating' => [
        'rules' => [
            'rate_number' => 'required|integer|min:1|max:5',
            'rate_comment' => 'max:255',
            'washer_id' => 'required|exists:washer__washers,id',
            'washrequest_id' => 'required|exists:washrequest__washrequests,id'
        ],
        'messages' => [
            
        ]
    ],
    
  
];
