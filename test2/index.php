<?php

require 'app/bootstrap.php';

$check = new App\Helpers\Xlsreader();

/**
 Type_A
 */
$typeA = $check->startRead('Type_A.xlsx');
$responseA = $check->validationData($typeA);

/**
 Type_B
 */
$typeB = $check->startRead('Type_B.xlsx');
$responseB = $check->validationData($typeB);

/**
 Type_B_FIX
 */
$typeBFix = $check->startRead('Type_B_Fix.xlsx');
$responseBfix = $check->validationData($typeBFix);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test 2 Results</title>
	<style>
	* {
	  box-sizing: border-box;
	}
	.row {
	  display: flex;
	}
	.column {
	  flex: 50%;
	  padding: 10px;
	}
	</style>
</head>
<body>
	<h1>Type A</h1>
	<table border="1">
		<thead>
			<tr>
				<th>Row</th>
				<th>Error</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($responseA as $i => $item): ?>
				<tr>
					<td><?php echo $i;?></td>
					<td>
						<?php
							$dataError = implode(', ', $item);
							echo $dataError;
						?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<h1>Type B</h1>
	<table border="1">
		<thead>
			<tr>
				<th>Row</th>
				<th>Error</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($responseB as $i => $item): ?>
				<tr>
					<td><?php echo $i;?></td>
					<td>
						<?php
							$dataError = implode(', ', $item);
							echo $dataError;
						?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<h1>Type B Fix</h1>
	<table border="1">
		<thead>
			<tr>
				<th>Row</th>
				<th>Error</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($responseBfix as $i => $item): ?>
				<tr>
					<td><?php echo $i;?></td>
					<td>
						<?php
							$dataError = implode(', ', $item);
							echo $dataError;
						?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<hr>
	<div class="row">
	    <div class="column" style="background-color:#aaa;">
	        <h2>Read Data From Type_B.xlsx</h2>
	        <pre>
	        	<?php print_r($typeB);?>
	        </pre>
	    </div>
	    <div class="column" style="background-color:#bbb;">
	        <h2>Read Data From Type_B_Fix.xlsx</h2>
	        <pre>
	        	<?php print_r($typeBFix);?>
	        </pre>
	    </div>
	</div>
</body>
</html>