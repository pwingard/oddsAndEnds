<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//
//$str1 = 'yabadabadoo';
//$str2 = 'yaba';
//if (strpos($str1,$str2)) {
//    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
//} else {
//    echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
//}
//echo "<br />";echo "<br />";
///*
//The output will be: "yabadabadoo" does not contain "yaba"
//How can this code (strpos yabadabadoo) be fixed to work correctly?
//
//$str1 = 'yabadabadoo';
//$str2 = 'yaba';
//if (strpos($str1,$str2) !== false) {//<<<<<<<<<<<<<<<<<<<<<<<<
//    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
//} else {
//    echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
//}
// * */
//
//$x = 5;
//echo $x;
//echo "<br />";
//echo $x+++$x++;
//echo "<br />";
//echo $x;
//echo "<br />";
//echo $x---$x--;
//echo "<br />";
//echo $x;echo "<br />";echo "<br />";
///*
////What will be the output of the code below and why?
//OUTPUT
//5
//11
//7
//1
//5 
// 
//1. The term $x++ says to use the current value of $x and then increment it. 
//    Similarly, the term $x-- says to use the current value of $x and then
//    decrement it.
//2. The increment operator (++) has higher precedence then the sum operator (+)
//    in order of operations.
// * */
//
//$a = '1';
//$b = &$a;
//$b = "2$b";
//echo $a;echo "<br />";
//echo"$b";
//echo "<br />";echo "<br />";
///*
//What will be the values of $a and $b after the '&' code below is executed? 
//21
//21
//Both $a and $b will be equal to the string "21" after the above code is 
//executed. Here’s why:
//
//The statement $b = &$a; sets $b equal to a reference to $a (as opposed to 
//setting $b to the then-current value of $a). Thereafter, as long as $b 
//remains a reference to $a, anything done to $a will affect $b and vice 
//versa.
//
//So when we subsequently execute the statement $b = "2$b", $b is set equal 
//to the string "2" followed by the then-current value of $b (which is the 
//same as $a) which is 1, so this results in $b being set equal to the 
//string "21" (i.e., the concatenation of "2" and "1"). And, since $b 
//is a reference to $a, this has the same affect on the value of $a, 
//so both end up equal to "21".
// * */
//
//var_dump(0123 == 123);echo "<br />";
//var_dump('0123' == 123);echo "<br />";
//var_dump('0123' === 123);echo "<br />";echo "<br />";
////What will be the output of each of the statements below and why?
///*
//var_dump(0123 == 123) will output bool(false) because 
//the leading 0 in 0123 tells the PHP interpreter to treat 
//the value as octal (rather than decimal) value, and 123 octal 
//is equal to 83 decimal, so the values are not equal.
//
//var_dump('0123' == 123) will output bool(true) since the string 0123 
//will automatically be coerced to an integer when being compared with 
//an integer value. Interestingly, when this conversion is performed, 
//the leading 0 is ignored and the value is treated as a decimal 
//(rather than octal) value, so the values are bother 123 (decimal) 
//and are therefore equal.
//
//var_dump('0123' === 123) outputs bool(false) since it performs 
//a more strict comparison and does not do the automatic type coercion
//of the string to an integer.
// */
//
//array_merge(array(),array());
//echo "<br />";echo "<br />";
////What is the problem with the array_merge code below? What will it output? 
///*
//$referenceTable = array();
//$referenceTable['val1'] = array(1, 2);
//$referenceTable['val2'] = 3;
//$referenceTable['val3'] = array(4, 5);
//
//$testArray = array();
//
//$testArray = array_merge($testArray, $referenceTable['val1']);
//var_dump($testArray);
//$testArray = array_merge($testArray, $referenceTable['val2']);
//var_dump($testArray);
//$testArray = array_merge($testArray, $referenceTable['val3']);
//var_dump($testArray);
// 
// How can it be fixed?
// The issue here is that, if either the first or second argument 
// to array_merge() is not an array-->typecast 3 as an array
// * */
//
//$x = true and false;
//var_dump($x); // outputs -> bool(true)
//echo "<br />";echo "<br />";
///*
////What will this code ($x = true and false;) output and why? 
//var_dump($x); // outputs -> bool(true)
//Surprisingly to many, the above code will output bool(true) seeming to imply
//that the and operator is behaving instead as an or.
//
//The issue here is that the = operator takes precedence over the and operator 
//in order of operations, so the statement $x = true and false ends up being 
//functionally equivalent to:
//$x = true;       // sets $x equal to true
//true and false;  // results in false, but has no affect on anything
//This is, incidentally, a great example of why using parentheses to clearly 
//specify your intent is generally a good practice, in any language. 
//For example, if the above statement $x = true and false were replaced 
//with $x = (true and false), then $x would be set to false as expected.
// */
//
//$x = 3 + "15%" + "$25";
//echo $x;//-->18
//echo "<br />";echo "<br />";
///*
//What will $x be equal to after the statement $x = 3 + "15%" + "$25"?
//
//PHP supports automatic type conversion based on the context in which a 
//variable or value is being used.
//
//If you perform an arithmetic operation on an expression that contains a 
//string, that string will be interpreted as the appropriate numeric type 
//for the purposes of evaluating the expression. So, if the string begins 
//with one or more numeric characters, the remainder of the string (if any) 
//will be ignored and the numeric value is interpreted as the appropriate numeric type. On the other hand, if the string begins with a non-numeric character, then it will evaluate to zero.
//
//With that understanding, we can see that "15%" evaluates to the numeric 
//value 15 and "$25" evaluates to the numeric value zero, which explains 
//why the result of the statement $x = 3 + "15%" + "$25" is 18 (i.e., 3 + 15 + 0).
// */
//
//$text = 'John ';echo"$text";//-->John D
//echo "<br />";
//$text[10] = 'Doe';echo strlen($text);//-->11
//echo "<br />";echo "<br />";
///*
//After the code is executed, what
//will be the value of $text and what will strlen($text) return?
//
//After the above code is executed, the value of $text will be the string
//“John      D” (i.e., “John”, followed by 5 spaces, followed by “D”) 
//and strlen($text) will return 11.
//
//There are two things going on here.
//
//First of all, since $text is a string, setting a single element of $text 
//simply sets that single character to the value specified. The statement 
//$text[10] = 'Doe' therefore sets that single character to 'D' (i.e., 
//the first character in the string "Doe", since an element of a string 
//can only be a single character).
//
//Secondly, $text[10] = 'Doe' says to set the 11th character of the string (
//remember that indices are zero-based) to 'D'. Prior to that statement, 
//though, the length of the string $text ("John ") was only 5. Whereas 
//compilers or interpreters in other languages might barf (with something 
//akin to an out-of-bounds-index error) when you then attempt to set 
//the 11th character of a 5 character string, PHP instead is very 
//“accommodating” and instead allows this and sets all intermediate 
//characters to blanks.
//*/
//
////Cross-site scripting (XSS) 
///*
//Cross-site scripting (XSS) is a type of computer security vulnerability 
// * typically found in web applications. XSS enables attackers to inject 
// * client-side scripts into web pages viewed by other users. 
// * A cross-site scripting vulnerability may be used by attackers to 
// * bypass access controls such as the same-origin policy. 
//*/
//
////Magic Methods
///*__construct(), __destruct(), __get(), __set()
//These are Magic Methods that allow you to react to certain events when 
//using these particular objects. This means when certain things happen 
//to your object, you can define how it should react in that instance.
// */
//
////php types of inheritance
///*
// Explain the type of inheritance that php supports.
//- PHP supports single & multilevel inheritance. 
//- It does not support multiple inheritance.
//- In single inheritance, by using the extend keyword a class can
// *  inherit methods and members of another base class (only one). 
//- PHP uses the concept of inheritance only in the object model.
//- If a class extends another then the parent class is to be d
// * eclared before the child class.
//- The classes must be defined before they are used.
// */
//
////unlink vs unset
///*
// PHP - Difference between the functions unlink and unset.
// * Unlink is used to delete the file used in the context
// * Unset is used to unset or destroy the variable.
// */
//
////mysql_fetch_object() vs mysql_fetch_array()
///*
// * The difference is that mysql_fetch_object returns object:
// * while array returns an array
// */
//
////Q: What is the difference between public, protected and private 
////in a class definition?
///*
//A: public makes a class member available to "everyone", 
// * protected makes the class member available to only itself 
// * and derived classes, private makes the class member only available 
// * to the class itself.
// */
//
//var_dump(PHP_INT_MAX);//-->int(9223372036854775807)
//echo "<br />";
//var_dump(PHP_INT_MAX + 1);//-->float(9.22337203685E+18)
//echo "<br />";
//var_dump((int)(PHP_INT_MAX + 1));//->int(-9223372036854775808)
//echo "<br />";echo "<br />";
///*
// * The result of var_dump(PHP_INT_MAX + 1) will be displayed as a double 
// * (in the case of this specific example, it will display 
// * double(9.2233720368548E+18)). The key here is for the candidate to 
// * know that PHP handles large integers by converting them to doubles 
// * (which can store larger values).
//
//And interestingly, the result of var_dump((int)(PHP_INT_MAX + 1)) 
// * will be displayed as a negative number (in the case of this specific 
// * example, it will display int(-9223372036854775808)). Again, the key 
// * here is for the candidate to know that the value will be displayed 
// * as a negative number, not to know the precise value.
// */
//
////How would you sort an array of strings to their natural case-insensitive order, 
////while maintaing their original index association?
//$arr=array(
//	'0' => 'z1',
//	'1' => 'Z10',
//	'2' => 'z12',
//	'3' => 'Z2',
//	'4' => 'z3',
//);
//asort($arr, SORT_STRING|SORT_FLAG_CASE|SORT_NATURAL);
///*
//Array
//(
//    [0] => z1
//    [3] => Z2
//    [4] => z3
//    [1] => Z10
//    [2] => z12
//)*/
//
////PEAR (PHP Extension and Application Repository
//
////What are the differences between echo and print in PHP?
////echo does not return a value whereas print does return a value of 1 
////(this enables print to be used in expressions).
//
//$v = 1;
//$m = 2;
//$l = 3;
////if( $l > $m > $v){
////    echo "yes";
////}else{
////    echo "no";
////}
///*
// * Since 3 > 2 > 1, one might be fooled into thinking the output 
// * would be “yes”.
//In fact, though, the output will be “no”. Here’s why:
//First, $l > $m will be evaluated which yields a boolean value of 1 
// * or true. Comparing that boolean value to the integer value 1 
// * (i.e., bool(1) > $v) will result in NULL, so the output will be “no”.
// */
//
//$x = NULL;
//
//if ('0xFF' == 255) {
//    $x = (int)'0xFF';
//}
//echo $x;//-->0
///*
// Perhaps surprisingly, the answer is neither NULL nor 255. Rather, the answer 
// * is that $x will equal 0 (zero).
//Why?
//First, let’s consider whether '0xFF' == 255 will evaluate to true or false. 
// * When a hex string is loosely compared to an integer, it is converted to 
// * an integer. Internally, PHP uses is_numeric_string to detect that the 
// * string contains a hex value and converts it to an integer (since the 
// * other operand is an integer). So in this case, ‘0xFF’ is converted to 
// * its integer equivalent which is 255. Since 255 = 255, this condition 
// * evaluates to true. (Note that this only works for hex strings, not 
// * for octal or binary strings.)
//But if that’s the case, shouldn’t the statement $x = (int)'0xFF'; execute 
// * and result in $x being set equal to 255?
//Well, the statement does execute, but it results in $x being set equal to 0, 
// * not 255 (i.e., it is not set to the integer equivalent of ‘0xFF’). 
// * The reason is that the explicit type cast of the string to an integer 
// * uses convert_to_long (which works differently than the is_numeric_string 
// * function that was used in evaluating the conditional expression, as 
// * explained above). convert_to_long processes the string one character 
// * at a time from left to right and stops at the first non-numeric character 
// * that it reaches. In the case of ‘0xFF’, the first non-numeric character 
// * is ‘x’, so the only part of the string processed is the initial ‘0’. 
// * As a result, the value returned by (int)'0xFF' is 0, so when the code 
// * completes, $x will be equal to 0.
// */
//
//echo"yo";
//$_POST=array();
//
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//
//echo is_array($_POST);echo"yo";
//echo isset($_POST);echo"yo";
//echo is_null($_POST);echo"yo";
//
//echo "<br />";echo "<br />";echo "<br />";
//setcookie('start', 'test'); 
//session_start(); 
//$_SESSION['start'] = 'a test'; 
//echo var_dump($_COOKIE)






//array(2) { ["start"]=> string(4) "test" ["PHPSESSID"]=> string(32) "11ed955498414eb3126776f48ffa7438" }