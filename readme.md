# Autoloaduh
A reasonable generic autoloader. *duh..*

Example of usage:

    include 'AutoLoaduh.php';
    AutoLoader::RegisterPsr4('Xanthippe',__DIR__.'/src');
    
    $x = new Xanthippe\Xerxes(); // should work, if class exists of course
    
In the example above the class `Xerxes` with namespace `Xanthippe` should exist in file `Xerxes.php` in the `src` folder.
    
See `test.php` in the the `test` folder for more examples.
 


