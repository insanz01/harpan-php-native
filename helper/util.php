<?php

function acakCaptcha() {
  $kode = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

  $pass = array(); 

  $panjangkode = strlen($kode) - 2; 
  for ($i = 0; $i < 5; $i++) {
      $n = rand(0, $panjangkode);
      $pass[] = $kode[$n];
  }

  return implode($pass); 
}