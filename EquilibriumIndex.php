<?php


/**
 * Returns an array of equilibrium indexes from a sequential array.
 * 
 * @param  Array $arr
 * @return Array $output
 */
function getEquilibriums(Array $arr) {
	$output = array();
	# Logic goes here!
	// loop through $arr
	for($i = 0; $i < count($arr); $i++) { 
		// set an array for the left side. we do this so we don't 
		// change the original array when we use array_splice.
		$left = $arr;

		//grab everything for the left side of the index and add together.
		array_splice($left, $i);
		$leftSum = array_sum($left);

		// grab everything for the right side of the index and add together. 
		// notice the +1. this is to avoid adding itself to the array
		// I also could of combine these two line together but wanted to 
		// keep the $right variable to use below to test. 
		$right = array_slice($arr, $i+1);
		$rightSum = array_sum($right);

		// last we check if the two sums are equal and if they are we add 
		// it to the $output array.
		if($leftSum === $rightSum) $output[] = $i;

		// I left this in to show a visual representation of the process. 
		// uncomment below to view.
		// dd($left);
		// dd('Left Sum :'.$leftSum);
		// dd($right);
		// dd('Right Sum :'.$rightSum);
		// dd('===============');

	}
	// and don't forget to return the output.
	return $output; 
}

/**
 *	Helper function to dump out values in a more readable way. 
 * 
 * @param  Any $value
 */
function dd($value){
	print '<pre>';
	print_r($value);
	print '</pre>';
}

dd(getEquilibriums(array(-7, 1, 5, 2, -4, 3, 0)));




/**
 * So when I goggled equilibrium indexes I came across this code, 
 * not wanting to cheat I deiced I would come up with my own, but 
 * after I was done I wanted to come back and look at the code I 
 * found on-line. This code is a little better and I just wanted to 
 * go over it and add my own comments to explain how this works.
 *
 * The best thing about this code is that it doesn't call any php 
 * function inside the foreach loop which should be a big boost in 
 * performance.
 *
 * Also this keeps a running total where as the code on top recreates 
 * the totals each time it loops.
 * 
 * @param  Array $arr
 * @return Array $equilibriums
 */
function getEquilibriumsFoundOnline($arr) {

	// get the sum of the array right off the back.
    $right = array_sum($arr);  
    // set $left to 0 because at first there is nothing to the left.
    $left = 0; 
    // set an array to hold any value that return true.
    $equilibriums = array(); 
    // loop through the array. 
    // (I prefer foreach loops, just wanted to show another way up top)
    foreach($arr as $key => $value){ 
        // remove its own value from the right sum, this will keep a 
        // running total for the right sum.
        $right -= $value; 
        // checks if left and right are equal, if so add to the return array.
        if($left == $right) $equilibriums[] = $key; 
        // adds itself to the left sum for the next time it loops, this
        // will keep a running total of the left sum.
        $left += $value; 
    }
    return $equilibriums;
}

