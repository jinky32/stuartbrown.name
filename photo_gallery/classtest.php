<?php
	require_once '_/components/php/core/init.php';
	//include "_/components/php/header.php";
	$db =  DB::getInstance();
	$user = new User('jinky32');
	$fivehundredpx = new Fivehundredpx($db, $user); 
	//print_r($fivehundredpx->getUser());
	//print $fivehundredpx->getUser()->fivehundredpx;
	//print_r($fivehundredpx->fhpxEndpoint('user'));
	//print_r($fivehundredpx->fhpxEndpoint('user_favorites')->fhpxApiConnect());
	
	//print_r($fivehundredpx->fhpxApiPhotoSelect());
	//print_r($fivehundredpx->fhpxEndpoint('user_favorites')->fhpxApiConnect()->fhpxApiPhotoSelect());
	//$fivehundredpx->fhpxEndpoint('user_favorites')->fhpxApiConnect()->fhpxApiPhotoSelect();
	//$fivehundredpx->fhpxInsert();
	//$fivehundredpx->fhpxEndpoint('user_favorites');
		//$fivehundredpx->fhpxPhotoCompare();
	print_r($fivehundredpx->fhpxEndpoint('user_favorites')->fhpxDbImageSelect());
	//print_r($fivehundredpx->fhpxPhotoCompare()->fhpxNav());
	//print_r($fivehundredpx->fhpxEndpoint('user_favorites')->fhpxNav());
//$test = new Hello($user);
//$test->sayHello();
//var_dump($user);
//
//class Hello{
//	private $_class;
//public function __construct($user){
//		//print_r($user);
//		$this->_class=$user;           fhpxInsert
//		}
//
//public function sayHello(){
//	//print 'hello '. print $class->youtube;
//	//print_r($this->_class->data());
//	print 'hello '. $this->_class->data()->youtube;
//}
//
//}
//var_dump($fivehundredpx);fivehundredpx
//print $fivehundredpx->fivehundredpx;



?>



</form>

<?php



?>
</div>      



           
</div>

<script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>
  </body>
</html>


?>


