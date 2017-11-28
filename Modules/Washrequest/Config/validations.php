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
            
];
