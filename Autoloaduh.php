<?php
class Autoloaduh{
	/**
	* Register a PSR-4 autoloader
	* 
	* if $baseNS is 'Supercode' and $baseDir is '/src/classes'
	*    'SomeClass' will be ignored (does not have base namespace Supercode)
	*    'Supercode' will be ignored (is not a valid classname for this autoloader)
	*    'Supercode\Divider' will require '/src/classes/Divider.php'
	*    'Supercode\Interf\IDoable' will require '/src/classes/Interf/IDoable.php' 
	* if the required file does not exist the class will be ignored 
	* 
	* @param string $baseNS base namespace ('vendor-name')
	* @param string $baseDir base directory where classes are stored
	*/
	public static function RegisterPsr4($baseNS, $baseDir){

		$baseDir= realpath($baseDir);
    	if(!$baseDir){
			throw new Exception('Invalid basedir');
		}

		spl_autoload_register(
    		function ($class) use($baseNS , $baseDir) {
    			$parts = explode('\\',$class);
    			if($parts[0]!==$baseNS) return; // not mine;
				array_shift($parts);

				if(sizeof($parts)===0) return; // need at least one part besides base

				$file = $baseDir.DIRECTORY_SEPARATOR;
				$file.=implode(DIRECTORY_SEPARATOR,$parts);
				$file.='.php';

				if(file_exists($file)){
					require($file);
				}
		});

	}
	
	/**
	* Register an autoloader for one or more dirs
	* For classes not using namespaces 
	* PHP-file is class name + '.php'
	* Note this is not PSR0
	*  
	* @param mixed $dirs either array of string or scalar string, dir of dirs where class is to be sought
	*/
	public static function RegisterDir($dirs){
		
		if(!is_array($dirs)) $dirs = [$dirs];
		
		foreach($dirs as &$dir){
			$dir = realpath($dir);
			if(!$dir){
				throw new Exception('Invalid autoload dir');
			}
		}
		
		spl_autoload_register(
			function($class) use($dirs) {
				
				foreach($dirs as $dir){
					$file = $dir.DIRECTORY_SEPARATOR.$class.'.php';	
					if(file_exists($file)){
						require($file);
						return;
					}
				}
				
			}
		);	
	}

}


