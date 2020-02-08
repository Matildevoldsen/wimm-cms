<?php

Route::get('/{all}', 'AppController@view')->where(['all' => '.*']);
