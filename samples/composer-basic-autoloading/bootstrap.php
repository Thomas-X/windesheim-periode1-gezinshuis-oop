<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 19:53
 */

require 'vendor/autoload.php';

// use namespacing stuff here

use AutoloadingExample\Example;
use AutoloadingExample\examples\Example2;

var_dump()

$example2 = new Example2();
$example2::myMethod();

//$example = new Example();
//$example->myMethod();