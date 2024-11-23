<?php

define("BASE_URL", "http://localhost/cars/admin/");

function url($var = null)
{
    return BASE_URL . $var;
}

function getMessage($condition, $message = "No Message")
{
    if ($condition) {
        return $message;
    } else {
        return "False Insert";
    }
}

function redirect($var = null)
{
    echo "<script>
    window.location.replace('http://localhost/cars/admin/$var')
    </script>";
}

function auth($rule2 = null, $rule3 = null,$rule4 = null){
    if($_SESSION['admin']){
        if($_SESSION['admin']['rule'] == 1 || 
        $_SESSION['admin']['rule'] == $rule2 ||
        $_SESSION['admin']['rule'] == $rule3 ||
        $_SESSION['admin']['rule'] == $rule4){

        }
        else{
            redirect('error-404.php');
        }
    }
    else{
      redirect('login.php');
    }
}



function filterValidation($input_value){
    $input_value = trim($input_value);
    $input_value = strip_tags($input_value);
    $input_value = stripcslashes($input_value);
    $input_value = htmlspecialchars($input_value);

    return $input_value;
}

function stringValidation($input_value, $minLenpr = 3, $maxLenpr = 100){
    $empty = empty($input_value);
    $minLen = strlen($input_value) < $minLenpr;
    $maxLen = strlen($input_value) > $maxLenpr;

    if($empty || $minLen || $maxLen){
        return true;
    }
    else{
        return false; 
    }
}


function numberValidation($input_value){
    $empty = empty($input_value);
    $isNegative = $input_value <= 0;
    $isNotNumber = filter_var($input_value, FILTER_VALIDATE_FLOAT) == false;
    if($empty || $isNotNumber || $isNegative){
        return true;
    }
    else{
        return false;
    }
}

function emailValidation($input_value, $minLenpr = 3, $maxLenpr = 100){
    $empty = empty($input_value);
    $minLen = strlen($input_value) < $minLenpr;
    $maxLen = strlen($input_value) > $maxLenpr;
    $isNotEmail = filter_var($input_value, FILTER_VALIDATE_EMAIL) == false;
    if($empty || $minLen || $maxLen || $isNotEmail){
        return true;
    }
    else{
        return false; 
    }
}

function fileSizeValidation($file_size, $Required_size = 1){
    $sizeMiga = ($file_size / 1024) / 1024;
    $isBigerSize = $sizeMiga > $Required_size;
    if($isBigerSize){
        return true;
    }
    else{
        return false;
    }
}


function typeFileValidation($fileType, $type1 = null, $type2 = null, $type3 = null){
    if($fileType ==  "$type1"||
    $fileType ==  "$type2" ||
    $fileType ==  "$type3"){
        return false;
    }
    else{
        return true;
    }
}