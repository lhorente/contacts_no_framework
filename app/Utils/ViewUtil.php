<?php
namespace lhorente\Utils;

class ViewUtil
{
	static function loadTemplate($CONTENT){
		$strLayoutPath = '../app/Views/layout.php';
		// Require the file
		ob_start();
		require($strLayoutPath);

		// Return the string
		$strView = ob_get_contents();
		ob_end_clean();
		echo $strView;
	}
	
	static function loadView($strViewPath, $arrayOfData){
		// This makes $arrayOfData['content'] turn into $content
		extract($arrayOfData);

		$strViewPath = '../app/Views/'.$strViewPath.'.php';
		
		// Require the file
		ob_start();
		require($strViewPath);

		// Return the string
		$strView = ob_get_contents();
		ob_end_clean();

		\lhorente\Utils\ViewUtil::loadTemplate($strView);
	}
}