<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Seeder;

class GatewayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input_form = [
            [],
            [],
            [
                "account_holder_name" => [ 
                    "field_name" => "account_holder_name",
                    "field_level" => "Account holder name",
                    "type" => "text","validation" => "required"
                ],
                "account_number" => [
                    "field_name" => "account_number",
                    "field_level" => "Account Number",
                    "type" => "text","validation" => "required" ],
                "sending_receipt_screenshot" => [ 
                    "field_name" => "sending_receipt_screenshot",
                    "field_level" => "Sending Receipt Screenshot",
                    "type" => "file","validation" => "required"]
            ],
            [
                "sending_receipt_screenshot" => [ 
                    "field_name" => "sending_receipt_screenshot",
                    "field_level" => "Sending Receipt Screenshot",
                    "type" => "file","validation" => "required"]
            ],
            [
                [
                    "account_holder_name" => [
                        "field_name" => "account_holder_name",
                        "field_level" => "Account holder name",
                        "type" => "text","validation" => "required"],
                        "account_number" => [
                            "field_name" => "account_number",
                            "field_level" => "Account Number",
                            "type" => "text",
                            "validation" => "required"],
                            "sending_receipt_screenshot" => [
                                "field_name" => "sending_receipt_screenshot",
                                "field_level" => "Sending Receipt Screenshot",
                                "type" => "file","validation" => "required"]
                ]
            ]
                
        ];
        $parameters = [
            [
                'paypal_email' => [
                    'title' => 'Paypal Email',
                    'global' => true,
                    'value' => 'abdulmalikjutt26@gmail.com'
                ]
            ],
            [
                "passphrase" => [
                        "title" => "ALTERNATE PASSPHRASE",
                        "global" => true,
                        "value" => "6451561651551" 
                ],
                "wallet_id" => [
                    "title" => "PM Wallet",
                    "global" => false,
                    "value" => ""
                ]
            ],
            [],  
            [],
            []
        ];
        $currencies = [
            ["AUD" => "AUD" , "BRL" => "BRL" , "CAD" => "CAD" , "CZK" => "CZK" , "DKK" => "DKK" , "EUR" => "EUR" , "HKD" => "HKD" , "HUF" => "HUF" , "INR" => "INR" , "ILS" => "ILS" , "JPY" => "JPY" , "MYR" => "MYR" , "MXN" => "MXN" , "TWD" => "TWD" , "NZD" => "NZD" , "NOK" => "NOK" , "PHP" => "PHP" , "PLN" => "PLN" , "GBP" => "GBP" , "RUB" => "RUB" , "SGD" => "SGD" , "SEK" => "SEK" , "CHF" => "CHF" , "THB" => "THB" , "USD" => "$"],
            ["USD" => "$","EUR" => "\u20ac"],
            [],
            [],
            [],
        ];

        $images = [
            [
                'path' => 'https://aamearning.com/assets/images/gateway/610cef45bbb781628237637.jpeg',
                'size' => '800 x 800',
                'mime_type' => 'jpeg',
                'type' => 'image',
                'is_external' => 1
            ],
            [
                'path' => 'https://aamearning.com/assets/images/gateway/5f6f1d2a742211601117482.jpg',
                'size' => '800 x 800',
                'mime_type' => 'jpg',
                'type' => 'image',
                'is_external' => 1
            ],
            [
                'path' => 'https://aamearning.com/assets/images/gateway/60851ceec5b2b1619336430.png',
                'size' => '800 x 800',
                'mime_type' => 'png',
                'type' => 'image',
                'is_external' => 1
            ],
            [
                'path' => 'https://aamearning.com/assets/images/gateway/60d5b9019395f1624619265.jpg',
                'size' => '800 x 800',
                'mime_type' => 'png',
                'type' => 'image',
                'is_external' => 1
            ],
            [
                'path' => 'https://aamearning.com/assets/images/gateway/616a954e48e091634374990.png',
                'size' => '800 x 800',
                'mime_type' => 'png',
                'type' => 'image',
                'is_external' => 1
            ],

        ];
        $data = [
                    [
                        'code' => 101,
                        'name' => 'Paypal',
                        'slug' => 'paypal',
                        'status' => false,
                        'parameters' => json_encode($parameters[0]),
                        'supported_currencies' => json_encode($currencies[0]),
                        'crypto' => false,
                        'is_manual' => false,
                        'input_form' => json_encode($input_form[0]),

                    ],
                    [
                        'code' => 102,
                        'name' => 'Perfect Money',
                        'slug' => 'perfect_money',
                        'status' => true,
                        'parameters' => json_encode($parameters[1]),
                        'supported_currencies' => json_encode($currencies[1]),
                        'crypto' => false,
                        'is_manual' => true,
                        'input_form' => json_encode($input_form[1]),
                    ],
                    [
                        'code' => 1000,
                        'name' => 'JazzCash',
                        'slug' => 'jazzcash',
                        'status' => true,
                        'description' => '<h3><font face="georgia">Account holder name:</font></h3><div><font face="georgia"><b><font color="#cc3300">Hafiz</font></b> <b><font color="#cc3300">Abdul</font></b> <b><font color="#cc3300">Malik</font></b></font></div><h3><font face="georgia">Send Amount on JazzCash Account # <font color="#cc3300">0304<b style="">-1450855</b></font></font></h3>',
                        'parameters' => json_encode($parameters[2]),
                        'supported_currencies' => json_encode($currencies[2]),
                        'crypto' => false,
                        'is_manual' => true,
                        'input_form' => json_encode($input_form[2]),
                    ],
                    [
                        'code' => 1001,
                        'name' => 'Meezan bank',
                        'slug' => 'meezan_bank',
                        'status' => true,
                        'description' => '<h3><font face="georgia">Send Amount on Meezan Bank</font></h3><h3><font face="georgia">Account Title: <font color="#ff0033"><b>AAM EXPRESS<br></b></font></font></h3><h3><font face="georgia">Account Number: <font color="#ff0033"><b>05110105443301</b></font></font></h3>',
                        'parameters' => json_encode($parameters[3]),
                        'supported_currencies' => json_encode($currencies[3]),
                        'crypto' => false,
                        'is_manual' => true,
                        'input_form' => json_encode($input_form[3]),
                    ],
                    [
                        'code' => 1002,
                        'name' => 'Easypaisa',
                        'slug' => 'easypaisa',
                        'status' => true,
                        'description' => '<h3><font face="georgia">Account holder name:</font></h3><div><font face="georgia"><span style="font-weight: bolder;"><font color="#cc3300">Hafiz</font></span>&nbsp;<span style="font-weight: bolder;"><font color="#cc3300">Abdul</font></span>&nbsp;<span style="font-weight: bolder;"><font color="#cc3300">Malik</font></span></font></div><h3><font face="georgia">Send Amount on easypaisa Account #&nbsp;<font color="#cc3300">0304<span style="font-weight: bolder;">-1450855</span></font></font></h3>',
                        'parameters' => json_encode($parameters[4]),
                        'supported_currencies' => json_encode($currencies[4]),
                        'crypto' => false,
                        'is_manual' => true,
                        'input_form' => json_encode($input_form[4]),
                    ],
            ];
        for($i=0; $i < count($data); $i++){ 
            $g = Gateway::create($data[$i]);
            $g->media()->create($images[$i]);
        }
    }
}
