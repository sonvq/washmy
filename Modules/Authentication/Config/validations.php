<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'api-check-type-register' => [
        'rules' => [
            'type' => 'required|in:customer,washer',
        ],
        'messages' => [
            
        ]
    ],
    
    'api-check-washer-register' => [
        'rules' => [
            'email' => 'required|email|unique:users,email|unique:washer__washers,email|unique:customer__customers,email|max:255',
            'full_name' => 'required|max:255',
            'password' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'employment_type' => 'required|in:employed,self_employed,student,homemaker'
        ],
        'messages' => [
            
        ]
    ],    
    
    'api-check-customer-register' => [
        'rules' => [
            'email' => 'required|email|unique:users,email|unique:washer__washers,email|unique:customer__customers,email|max:255',
            'full_name' => 'required|max:255',
            'password' => 'required|max:255',
            'phone_number' => 'required|max:255',
        ],
        'messages' => [
            
        ]
    ],
    
];
