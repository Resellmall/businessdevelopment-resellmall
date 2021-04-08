<?php

function isAdmin(){
    if (session()->has('roleId') && session()->get('roleId') == 5 ) {
        return true;
    }    
}