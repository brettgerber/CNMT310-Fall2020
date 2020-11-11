<?php

/* 
 * The use of require_once for including common code is a common but "older" 
 * style, where "older" means that you need to think ahead about architecture
 * prior to using it.  It becomes easy to make a bit of a mess when manually
 * loading using require_once in this style.  However, with any level
 * of planning, even agile-style planning, this method works and scales.
 * Notably, the webserver can auto-prepend the file so that even 
 * the "require_once" doesn't need to be here.
 *
 * The other advantage to this method of including files is 
 * that it is readily explainable and easy to troubleshoot, both 
 * of which are helpful when learning the material.
 * 
 * Composer and its style of autoloading is common in newer
 * codebases.  Composer manages dependencies and helps signicantly
 * with development, especially when starting a new project.
 * But composer also requires forethought and, notably, 
 * composer adds non-trivial syntactical complexity to a project.
 * It's easy to make a bit of a mess with composer too but 
 * much more difficult to clean up when things go wrong.
 * 
*/ 
require_once("includes.php");
if (isset($_SESSION['isLoggedIn'])) {
  $_SESSION['isLoggedIn'] = false;
}
$required = array("username","pass");
$_SESSION['errors'] = array();
foreach ($required as $index => $value) {
  if (!isset($_POST[$value]) || empty($_POST[$value])) {
    $_SESSION['errors'][] = "Username and password are required";
    die(header("Location: " . LOGIN_PAGE));
  }
}

// Bringing in the users
// This is not usually done in production
// but we're mocking up some authentication temporarily.
include('users.php');

// Better, but would still be unmanageable at scale.
if (array_key_exists($_POST['username'],$users)) {
  if (password_verify($_POST['pass'],$users[$_POST['username']]) === true) {
    // This value should come from the database and not from post.
    // Removing any HTML-looking tags, just in case, but 
    // this is not something that I would let go into production.
    $_SESSION['username'] = strip_tags($_POST['username']);

    $_SESSION['isLoggedIn'] = true;
    die(header("Location: " . AUTHENTICATED_HOME)); 
  }
}


//This is the default action, whether user was not found or password was invalid
$_SESSION['errors'][] = "Invalid password or user not found";
die(header("Location: " . LOGIN_PAGE)); 
