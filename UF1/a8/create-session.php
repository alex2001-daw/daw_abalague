<?php
session_start();
require 'stripe/init.php';
require "llibreria.php";
$_SESSION["seguretat"]=generateRandomString(); 

\Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
header('Content-Type: application/json');
$YOUR_DOMAIN = 'http://dawjavi.insjoaquimmir.cat';
$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => $_SESSION["preutotal"]."00",
      'product_data' => [
        'name' => 'productes alex',
        'images' => ["http://dawjavi.insjoaquimmir.cat/abalague/UF1/a8/images/mono.jpg"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/abalague/UF1/a8/success.php?clau='.$_SESSION["seguretat"],
  'cancel_url' => $YOUR_DOMAIN . '/abalague/UF1/a8/cancel.php',
]);
echo json_encode(['id' => $checkout_session->id]);