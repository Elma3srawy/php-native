<?php

function set_language(){
   if(in_array(request('lang') , config('lang.langs')))
    set_locale(request('lang'));
    if (isset($_SERVER['HTTP_REFERER'])) {
        back();
    }
   return redirect('/');
}