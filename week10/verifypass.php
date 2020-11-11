<?php

// This would never be stored in-file for production-level code
// In class example only
$users = array(
  "steve" => '$2y$10$JThL4gLkWxhbFVXVI9daa.kpZt0d6E9.iBvFTx5vziwBV5zrWOB7O',
  "bob" => '$2y$10$IXzgu4ZSPlAsHxq7D7nf0.zwXGJ/LrgXEKzzSKX8jYmvCkQ/AYQ/a',
);

//verify values from post are set and not empty,
// perform validation as needed
$_POST['username'] = "steve";
$_POST['password'] = "boihfwhefio";

if (array_key_exists($_POST['username'],$users)) {
  if (password_verify($_POST['password'],$users[$_POST['username']])) {
    print "password match";
  } else {
    print "User not found or password incorrect";
  }
} else {
  print "User not found or password incorrect";
}

