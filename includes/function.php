<?php

function redirect_to($value='')
{
  header("Location:".$value);
  exit;
}

 ?>
