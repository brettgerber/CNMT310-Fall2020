<?php

require_once("classes/SiteTemplate.php");

$page = new SiteTemplate("Form Page");
$page->addHeadElement('<link rel="stylesheet" href="styles/login.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();
print "<form class=\"form-signin\" action=\"login_action.php\" method=\"POST\">";
print "<h1 class=\"h3 mb-3 font-weight-normal\">Please sign in</h1>\n";
print "<label for=\"inputUser\" class=\"sr-only\">Username</label>";
print "<input type=\"text\" name=\"username\" class=\"form-control\" id=\"inputUser\" placeholder=\"Username\" autofocus>";
print "<label for=\"inputPassword\" class=\"sr-only\">Password</label>";
print "<input type=\"password\" name=\"pass\" class=\"form-control\" id=\"inputPassword\" placeholder=\"Password\">";
print "<button type=\"submit\" class=\"btn btn-lg btn-primary btn-block\">Sign in</button>";
print "</form>\n";
print $page->getBottomSection();
