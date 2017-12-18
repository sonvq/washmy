<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'api-create-wash-request' => [
        'rules' => [
            'type' => 'required|in:saloon_hatchback_mini_van,mpv_suv_van',
            'car_plate_no' => 'required|max:255',
            'car_color' => 'required|max:255',
            'street_name' => 'required|max:255',
            'block_no' => 'required|max:255',
            'level' => 'required|max:255',
            'car_park_lot_no' => 'required|max:255',
            'save_for_next_time' => 'required|in:yes,no'
        ],
        'messages' => [
            
        ]
    ],
    
    'api-washer-change-request-status' => [
        'rules' => [
            'status' => 'required|in:washer_washing,washer_done'
        ],
        'messages' => [
            
        ]
    ],
    
        
    'api-customer-change-request-status' => [
        'rules' => [
            'status' => 'required|in:user_requesting,user_declined,user_accept_pay,user_payment_done,user_cancel_request,user_confirm_request'
        ],
        'messages' => [
            
        ]
    ],    
];
