<?php 
session_start();
require_once('../connection/connection.php');
$customer_fnameErr = $customer_lnameErr = $customer_telErr = $customer_areaErr = $customer_emailErr = "";
$customer_fname = $customer_lname = $customer_tel = $customer_area = $customer_email= "";

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['submit'])) {
  
  if (empty($_POST['customer_fname'])) {
    $customer_fnameErr = "First Name is required";
  }else{
    $customer_fname = test_input($_POST['customer_fname']);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$customer_fname)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
    if (empty($_POST['customer_lname'])) {
    $customer_lnameErr = "Last Name Is Required";
  }else{
    $customer_lname = test_input($_POST['customer_lname']);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$customer_lname)) {
      $customer_lnameErr = "Only letters and white space allowed";
    }
  }
  if(empty($_POST['customer_tel'])){
    $customer_telErr = "Customer Phone Number is Required";
  }else{
    $customer_tel = test_input($_POST['customer_tel']);

  }
   if(empty($_POST['customer_area'])){
    $customer_areaErr = "Customer Area is Required";
  }else{
    $customer_area = test_input($_POST['customer_area']);

  }
  if (empty($_POST['customer_email'])) {
    $customer_email = "NULL";
    
  }else{
    $customer_email = test_input($_POST['customer_email']);
  }

try {
 if ($customer_fname && $customer_lname && $customer_email && $customer_tel && $customer_area) {
    $sql = "INSERT INTO customers(customer_fname, customer_lname, customer_tel, customer_area, customer_email) VALUES (:customer_fname, :customer_lname, :customer_tel, :customer_area,:customer_email) ";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
  ":customer_fname"=>$customer_fname,
  ":customer_lname"=>$customer_lname,
  ":customer_tel"=>$customer_tel,
  ":customer_area"=>$customer_area,
  ":customer_email"=>$customer_email
));
$_SESSION['CREATE_USER_SUCCESS_MESSAGE'] ="<p class='text-2x1 py-2 bg-green-500 pl-2 text-white'>".$customer_fname." Created</p>";
header('Location: http://localhost/ms/customers/create.php');
return ;
 }else{
  echo  "";
 }
} catch (Exception $e) {
  echo "error". $e->getMessage();
}
}
 ?>

 <!DOCTYPE html>
<html>
 <head>
 	<title>Add Customer</title>
 	<link rel="stylesheet" type="text/css" href="../styles/tailwind.css">
 </head>
 <body>
	<div class="container w-full pt-6">
		<h1 class="ml-6">Create Customer</h1>
      <div class="ml-6">
       <?php 

        if($customer_fnameErr){
         echo "<p class='error py-2 px-3 bg-red-500 mt-2 text-white'>".$customer_fnameErr."</p>"; 
        }
         if($customer_lnameErr){
         echo "<p class='error py-2 px-3 bg-red-500 mt-2 text-white'>".$customer_lnameErr."</p>"; 
        }
         if($customer_telErr){
         echo "<p class='error py-2 px-3 bg-red-500 mt-2 text-white'>".$customer_telErr."</p>"; 
        } 
        if($customer_areaErr){
         echo "<p class='error py-2 px-3 bg-red-500 mt-2 text-white'>".$customer_areaErr."</p>"; 
        }
          if($customer_emailErr){
         echo "<p class='error py-2 px-3 bg-red-500 mt-2 text-white'>".$customer_emailErr."</p>"; 
        }

        if (isset($_SESSION['CREATE_USER_SUCCESS_MESSAGE'])) {
          echo "<p>".$_SESSION['CREATE_USER_SUCCESS_MESSAGE']."</p>";
          unset($_SESSION['CREATE_USER_SUCCESS_MESSAGE']);
        }
       ?>
      </div>
		<form class="w-full max-w-sm mt-3" action="" method="POST">
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-first-name">
        First Name
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="" name="customer_fname">
    </div>
  </div>
    <div>
      </div>
    <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-last-name">
        Last Name
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="" name="customer_lname">
    </div>

  </div>
    <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-Tel-number">
        Tel
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="" name="customer_tel">
    </div>

  </div>
    <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-area">
        Area
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="" name="customer_area">
    </div>

  </div>
    <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-email-address">
        Email Address
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="" name="customer_email">
    </div>

  </div>
  <div class="md:flex md:items-center">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
      <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" name="submit">
        Submit
      </button>
    </div>
  </div>
</form>
	</div>
 </body>
 </html>