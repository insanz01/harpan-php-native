<?php

include "helper/helper.php";
include "database/db.php";

$totalKomoditasQuery = "SELECT COUNT(*) as total FROM komoditas";
$totalStokQuery = "SELECT COUNT(*) as total FROM stok_komoditas";
$totalPermintaanQuery = "SELECT COUNT(*) as total FROM permintaan";
$totalInflasiQuery = "SELECT COUNT(*) as total FROM inflasi";

$eceranUnverifiedQuery = "SELECT COUNT(*) as total FROM harga_eceran WHERE approved_at is NULL";
$distributorUnverifiedQuery = "SELECT COUNT(*) as total FROM harga_distributor WHERE approved_at is NULL";
$grosirUnverifiedQuery = "SELECT COUNT(*) as total FROM harga_grosir WHERE approved_at is NULL";
$nasionalUnverifiedQuery = "SELECT COUNT(*) as total FROM harga_nasional WHERE approved_at is NULL";
$produsenUnverifiedQuery = "SELECT COUNT(*) as total FROM harga_produsen WHERE approved_at is NULL";

$resultKomoditas = mysqli_query($connection, $totalKomoditasQuery);
$totalKomoditas = 0;
if($resultKomoditas->num_rows > 0) {
  $totalKomoditas = $resultKomoditas->fetch_assoc();
  $totalKomoditas = $totalKomoditas["total"];
}

$resultStok = mysqli_query($connection, $totalStokQuery);
$totalStok = 0;
if($resultStok->num_rows > 0) {
  $totalStok = $resultStok->fetch_assoc();
  $totalStok = $totalStok["total"];
}

$resultPermintaan = mysqli_query($connection, $totalPermintaanQuery);
$totalPermintaan = 0;
if($resultPermintaan->num_rows > 0) {
  $totalPermintaan = $resultPermintaan->fetch_assoc();
  $totalPermintaan = $totalPermintaan["total"];
}

$resultInflasi = mysqli_query($connection, $totalInflasiQuery);
$totalInflasi = 0;
if($resultInflasi->num_rows > 0) {
  $totalInflasi = $resultInflasi->fetch_assoc();
  $totalInflasi = $totalInflasi["total"];
}

$eceranUnverifiedResult = mysqli_query($connection, $eceranUnverifiedQuery);
$distributorUnverifiedResult = mysqli_query($connection, $distributorUnverifiedQuery);
$grosirUnverifiedResult = mysqli_query($connection, $grosirUnverifiedQuery);
$nasionalUnverifiedResult = mysqli_query($connection, $nasionalUnverifiedQuery);
$produsenUnverifiedResult = mysqli_query($connection, $produsenUnverifiedQuery);

$totalUnverified = 0;

if($eceranUnverifiedResult->num_rows > 0) {
  $totalTemp = $eceranUnverifiedResult->fetch_assoc();
  $totalUnverified += $totalTemp["total"];
}

if($distributorUnverifiedResult->num_rows > 0) {
  $totalTemp = $distributorUnverifiedResult->fetch_assoc();
  $totalUnverified += $totalTemp["total"];
}

if($grosirUnverifiedResult->num_rows > 0) {
  $totalTemp = $grosirUnverifiedResult->fetch_assoc();
  $totalUnverified += $totalTemp["total"];
}

if($nasionalUnverifiedResult->num_rows > 0) {
  $totalTemp = $nasionalUnverifiedResult->fetch_assoc();
  $totalUnverified += $totalTemp["total"];
}

if($produsenUnverifiedResult->num_rows > 0) {
  $totalTemp = $produsenUnverifiedResult->fetch_assoc();
  $totalUnverified += $totalTemp["total"];
}