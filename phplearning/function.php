<?php

$names = array('jhn','jee','stuart');

$people = array(
	array('name'=>'STuart', 'age'=>36, 'title'=>'Mr'),
	array('name'=>'John', 'age'=>20, 'title'=>'Mr'),
	array('name'=>'sarah', 'age'=>57, 'title'=>'Mrs')
	);

// function say_hello($name){
// 	return "Hi There $name";
// }
// echo say_hello('Joe');

function pp($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function array_pluck($toPluck,$arr){
	$ret=array();

	foreach ($arr as $item){
		$ret[]=$item[$toPluck];
	}
	return $ret;
}

$plucked = array_pluck('name',$people);
print_r($plucked);

//pp($people);

?>