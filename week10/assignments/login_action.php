<?php

$errors = array();
$loginResult = false;

$required = array("username","pass");
foreach ($required as $index => $value) {
  if (!isset($_POST[$value]) || empty($_POST[$value])) {
    $errors['fields'] = "Missing fields";
  }
}

// Bringing in the users
// This is not usually done in production
// but we're mocking up some authentication temporarily.
// Contains $users = array("username" => "hash/encrypted pass","adminuser" => "hash/encrypted pass");
include('users.php');

// This would not be viable in production - It's a hard-coded loop
//foreach ($users as $username => $password) {

// Better, but would still be unmanageable at scale.
if (array_key_exists($_POST['username'],$users)) {
  $loginResult = password_verify($_POST['pass'],$users[$_POST['username']]);
} else {
  $errors['login'] = "Password invalid or user not found";
}

if ($loginResult !== true) {
  $errors['login'] = "Password invalid or user not found";
}
require_once("classes/SiteTemplate.php");

$page = new SiteTemplate("Form Page");
$page->addHeadElement('<link rel="stylesheet" href="styles/login.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();
print "<form class=\"form-signin\" action=\"login_action.php\" method=\"POST\">";
if (count($errors) > 0) {
  foreach ($errors as $key => $message) {
    print $message . "<br/>\n";
  }
  print "<h1 class=\"h3 mb-3 font-weight-normal\">Please sign in</h1>\n";
  print "<label for=\"inputUser\" class=\"sr-only\">Username</label>";
  print "<input type=\"text\" name=\"username\" class=\"form-control\" id=\"inputUser\" placeholder=\"Username\" autofocus>";
  print "<label for=\"inputPassword\" class=\"sr-only\">Password</label>";
  print "<input type=\"password\" name=\"pass\" class=\"form-control\" id=\"inputPassword\" placeholder=\"Password\">";
  print "<button type=\"submit\" class=\"btn btn-lg btn-primary btn-block\">Sign in</button>";
  print "</form>\n";
} else {
  print "You have logged in";
}
print $page->getBottomSection();
