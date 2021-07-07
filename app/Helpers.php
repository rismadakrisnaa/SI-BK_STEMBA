<?php

if(!function_exists('tanggal')){
    function tanggal($date,$format){
        setlocale(LC_ALL, 'IND');
        return strftime($format, strtotime($date));
    }
}
