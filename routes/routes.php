<?php

$routes=
    [
        "get"=>
            [
                "/"         =>"Application@getIndex",
                "/home"     =>"Application@getIndex",
                "/about-us" =>"Application@getAbout_Us",
                "/signin"    =>"Application@getSignin",
                "/signup"   =>"Application@getSignup",
            ],
        "post"=>
            [
                
                "/"                     =>"Application@postIndex",
                "/home"                 =>"Application@postIndex",
                "/signup"               =>"Application@postSignup",
                "/signin"               =>"Application@postSignin",
            ],
    ]
    
    
?>