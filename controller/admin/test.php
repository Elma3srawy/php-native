<?php 


function test(){
    session_forget('admin');
    var_dump(auth('admin'));
}