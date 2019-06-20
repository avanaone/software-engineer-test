<?php

function testOne($strVal,$intVal) {
	$matchVal = "("; // The value where we must be check.

	if (is_int($intVal)) { //Check if $intVal value is integer
		if (substr($strVal,$intVal,1) == $matchVal) { // Check if part of string have match value "("
			$lengthStr = strlen($strVal); // Count string length
			$level = 1; // Start with 1
			for ($i = $intVal + 1; $i < $lengthStr; $i++) { // Loop
				switch (substr($strVal,$i,1)) { // Condition
					// Add level++ if found match value "("
					case '(':
						$level++;
						break;
					// Reduce level-- if found match value ")"
					case ')':
						$level--;
						if ($level == 0) { // If no longer match value "("
							return $i; // Just return index
						}
						break;
				}
			}
			return 'Cannot be found';  // Cannot find index
		} else {
			return 'No Match value'; // No Match value
		}
	} else {
		return 'You must enter integer value'; // $intVal value is not integer
	}
}
$response = testOne("a (b c (d e (f) g) h) i (j k)", 2);
echo $response;
?>