<?php
namespace Test2;

// Test 2
// Write a psr-4 package to validate excel file format and its data. For this test, you will have to validate two type of excel file Type_A and Type_B.
//
// General Rules
// Column name that starts with # should not contain any space
// Column name that ends with * is a required column, means it must have a value
// For each file type, it should validate the header columns name and the amount of columns it has
// For example, Type_A file should only contains 5 columns and the header column name should be and follows the following order;
// Field_A*
// #Field_B
// Field_C
// Field_D*
// Field_E*
// The package should be able to validate both .xls and .xlsx file
// You may use third party library to parse the excel file
// Two sample file is provided namely Type_A.xlsx and Type_B.xlsx
//
// Sample Output when validating Type_A.xlsx
//
// Row	Error
// 3	Missing value in Field_A, Field_B should not contain any space, Missing value in Field_D
// 4	Missing value in Field_A,Missing value in Field_E
// Sample Output when validating Type_B.xlsx
//
// Row	Error
// 3	Missing value in Field_A, Field_B should not contain any space

use Test2\Models\WorksheetA;
use Test2\Models\WorksheetB;


class Test2{
    //init the test2
    public static function init(){
        echo "Type A File";
        static::processTypeAFile();

        echo "Type B File";
        static::processTypeBFile();
    }

    //process type a file
    public static function processTypeAFile(){
        $worksheet = new WorksheetA( __DIR__ . '/../Type_A.xlsx' );
        $worksheet->printErrors();
    }

    //process type b file
    public static function processTypeBFile(){
        $worksheet = new WorksheetB( __DIR__ . '/../Type_B.xlsx' );
        $worksheet->printErrors();
    }
}
