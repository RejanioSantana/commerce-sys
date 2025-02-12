<?php

function whatsappNumber($number)
    {
        $n = str_replace("(","", $number);
        $n = str_replace(")","", $n);
        $n = str_replace(" ","", $n);
        $n = str_replace("-","", $n);
        return intval($n);
    }