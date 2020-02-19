<?php
function merge_sort($my_array){
	if(count($my_array) == 1 ) return $my_array;
    
    $mid = count($my_array) / 2;
    $left = array_slice($my_array, 0, $mid);
    $right = array_slice($my_array, $mid);

	$left = merge_sort($left);
    $right = merge_sort($right);
    return merge($left, $right);
    
}
function merge($left, $right){
	$res = array();
	while (count($left) > 0 && count($right) > 0){
		if($left[0] > $right[0]){
			$res[] = $right[0];
			$right = array_slice($right , 1);
		}else{
			$res[] = $left[0];
			$left = array_slice($left, 1);
		}
	}
	while (count($left) > 0){
		$res[] = $left[0];
		$left = array_slice($left, 1);
	}
	while (count($right) > 0){
		$res[] = $right[0];
		$right = array_slice($right, 1);
	}
	return $res;
}

$random_number_array = range(0, 100000);
shuffle($random_number_array);
    
$start_time = microtime(true);



//$test_array = array('b','h','y','t','g','j','h','f','v','ø','s','a','q',);
$test_array = array('jeg','kan','godt','lide','bajer','baajer','hfgh','fsaa','vdfg','ødfg','s','a','q',);
//echo implode(', ', $random_number_array );
echo "Original Array : ";
echo implode(', ',$test_array );
echo "\nSorted Array :";
echo implode(', ', merge_sort($random_number_array))."\n";
$end_time = microtime(true);
echo $end_time - $start_time . 'sec';




?>