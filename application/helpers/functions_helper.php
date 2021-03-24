<?php
  function Empty2Null($value)
  {
    if (empty($value)) {
      $res = NULL;
    }
    else {
      $res = $value;
    }
    return $res;
  }

  function Null2Empty($value)
  {
    if (is_null($value)) {
      $res = "";
    }
    else {
      $res = $value;
    }
    return $res;
  }

  function check_date($str) {
    if (strlen($str) != 10) {return FALSE;};

    $dd = (int)substr($str, 0, 2);
    $mm = (int)substr($str, 3, 2);
    $yyyy = (int)substr($str, 6, 4);

    return checkdate($mm, $dd, $yyyy);
  }

  function DMY2YMD($str) {
    if ($str == null){
      return null;
    }elseif (strlen($str)==10){    
      $data = explode("/", $str);
      return $data[2] . '-' . $data[1] . '-' . $data[0];
    }else{
      return '';
    }
  }
  
  function YMD2DMY($str) {
    if ($str == null){
      return null;
    }elseif (strlen($str)==10){
      $data = explode("-", $str);
      return $data[2] . '/' . $data[1] . '/' . $data[0];    
    }else{
      return '';
    }
  }
