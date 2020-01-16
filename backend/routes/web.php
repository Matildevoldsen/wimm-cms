<?php

Route::get('/{all}', function () {
    return view('index');
})->where(['all' => '.*']);;
