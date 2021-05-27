<?php

class Page{


	public static function redirectPage($page = null, $message = null){

		if($page){	

			$page = "${page}.php";

			header("location: ${page}");
		}


	}

}