<?php
/**
* 
*/
class TestController extends Controller
{
	

	public function test(){
	
	$a = new EntityManager('Species');
	// $a->Delete();
	
	return $this->render("test.php", ['a' => $a->Read()]);

	}


}