<?php

namespace App\Helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class Xlsreader
{
	/**
	 * Validation file extention
	 *
	 * @param      file   $file   The file
	 *
	 * @return     boolean
	 */
	public function fileValidation($file)
	{
		$valid = false;
		$ext = pathinfo($file);
		if ($ext['extension'] === 'xls' || $ext['extension'] === 'xlsx') {
			$valid = true;
		}

		return $valid;
	}


	/**
	 * Starts a read.
	 *
	 * @param      file  $file   The file
	 *
	 * @return     array
	 */
	public function startRead($file)
	{
		$validFile = $this->fileValidation($file);
		if (!$validFile) return 'File extension is not valid!';

		$spreadsheet = IOFactory::load($file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		return $sheetData;
	}


	/**
	 * Type_A File Rules
	 *
	 * @param      array  $data   The data
	 *
	 * @return     array
	 */
	public function ruleType(array $data)
	{
		$errors = array();
		if (!empty($data)) {
			$getCol = reset($data);
			if (is_array($getCol)) {
				// Validation total column
				if (count($getCol) > 5) {
					$errors[] = 'The number of columns must be less than 5';
				}
				// Validation Header Format
				if (isset($getCol['A']) && !empty($getCol['A'])) {
					if (substr($getCol['A'], -1) !== '*') {
						$errors[] = 'Missing column name format: '.$getCol['A'];
					}
				}
				if (isset($getCol['B']) && !empty($getCol['B'])) {
					if (substr($getCol['B'], 0, 1) !== '#') {
						$errors[] = 'Missing column name format: '.$getCol['B'];
					}
				}
				if (isset($getCol['C']) && !empty($getCol['C'])) {
					if (strpos($getCol['C'], '*') !== false || strpos($getCol['C'], '#') !== false) {
						$errors[] = 'Missing column name format: '.$getCol['C'];
					}
				}
				if (isset($getCol['D']) && !empty($getCol['D'])) {
					if (substr($getCol['D'], -1) !== '*') {
						$errors[] = 'Missing column name format: '.$getCol['D'];
					}
				}
				if (isset($getCol['E']) && !empty($getCol['E'])) {
					if (substr($getCol['E'], -1) !== '*') {
						$errors[] = 'Missing column name format: '.$getCol['E'];
					}
				}
			}
		}
		return $errors;
	}

	public function validationData(array $data)
	{
		// Validation Column Header
		$validHeader = $this->ruleType($data);
		if (!empty($validHeader)) return $validHeader;

		// Validation Data
		// 1. Column name that starts with # should not contain any space
		// 2. Column name that ends with * is a required column, means it must have a value
		$errors = array();
		$headers = reset($data);
		unset($data[1]);
		foreach ($data as $key => $items) {
			foreach ($items as $i => $item) {
				if (strpos($headers[$i], '*') !== false) {
					if (!$item) {
						$de = array(
							'row' => $key,
							'msg' => 'Missing value in '.$headers[$i]
						);
						$errors[$key][] = 'Missing value in '.$headers[$i];
					}
				}
				if (strpos($headers[$i], '#') !== false) {
					if ($this->spaceValidation($item)) {
						$des = array(
							'row' => $key,
							'msg' => $headers[$i].' should not contain any space'
						);
						$errors[$key][] = $headers[$i].' should not contain any space';
					}
				}
			}
		}

		return $errors;
	}

	public function spaceValidation($value)
	{
		return preg_match("/(\r|\n|\t|\s)/", $value);
	}
}
