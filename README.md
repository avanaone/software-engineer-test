# Getting Started

1. Fork this branch
2. Complete the Test 1 in folder test1
3. Complete the Test 2 in folder test2
4. Submit a pull request upon the completion

# Test 1

Write a function as follows:
- The function takes 2 arguments, a string and an integer
- Assume that the integer correctly indicates the index position of an open parenthesis "(" inside the given string
- The function should return an integer, that indicates the index position of the correct corresponding close paren ")" inside the string taking into account nested parenthesized values

You can write the function in PHP.

## Example

If the function receives "a (b c (d e (f) g) h) i (j k)" and 2 as arguments.

nameYourFunction("a (b c (d e (f) g) h) i (j k)", 2); // 2 here indicates the "(" right before "b"

The function should return the index position of the ")" right after "h", in this case, the return value is 20.


# Test 2

Write a psr-4 package to validate excel file format and its data. For this test, you will have to validate two type of excel file `Type_A` and `Type_B`.

## General Rules

1. Column name that starts with `#` should not contain any space
2. Column name that ends with `*` is a required column, means it must have a value
3. For each file type, it should validate the header columns name and the amount of columns it has
    - For example, `Type_A`  file should only contains 5 columns and the header column name should be and follows the following order;
      1. Field_A* 
      2. #Field_B 
      3. Field_C 
      4. Field_D* 
      5. Field_E*
4. The package should be able to validate both `.xls` and `.xlsx` file
5. You may use third party library to parse the excel file

Two sample file is provided namely `Type_A.xlsx` and `Type_B.xlsx`

Sample Output when validating `Type_A.xlsx`

| Row | Error |
| --- | --- |
| 3 | Missing value in Field_A, Field_B should not contain any space, Missing value in Field_D |
| 4 | Missing value in Field_A,Missing value in Field_E |

Sample Output when validating `Type_B.xlsx`

| Row | Error |
| --- | --- |
| 3 | Missing value in Field_A, Field_B should not contain any space |

## Bonus

It will be nice if new file type(`Type_C`) can be integrated by just adding `Type_C.js`

## Coding Recommendation

1. Follow DRY principle
2. Write simple but meaningful code
3. Incorporate design patterns in your code

### Enjoy your test!


# How to deploy

1. Clone/fork this repo
2. cd into the directory
2. Run "composer install"
3. Run "php -S localhost:8000"
4. Run in the browser
