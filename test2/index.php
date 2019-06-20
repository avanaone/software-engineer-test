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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test 2 Results</title>
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
</body>
</html>