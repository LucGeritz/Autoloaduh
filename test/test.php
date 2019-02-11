<?php
$curdir = __DIR__.'/'; 

include "$curdir../AutoLoaduh.php";

// classes with namespace
// .. note that base dir (MyClasses) and base namespace can differ
Autoloaduh::RegisterPsr4('Alfa',$curdir.'MyClasses');
// more classes with namespace
Autoloaduh::RegisterPsr4('Beta',$curdir.'VendorClasses');
// a single dir with classes with no namespace
Autoloaduh::RegisterDir($curdir.'Gamma');
// multiple dirs with classes with no namespace
Autoloaduh::RegisterDir([$curdir.'Delta',$curdir.'Jota']);


// These lines should run without error
$one = new Alfa\One();
$two = new Alfa\Sub\Two();
$three = new Beta\Three();

$four = new Four();
$five = new Five();
$six = new Six();