<?php
include('./class/Student.php');
$name=$_POST['name'];
$surname=$_POST['surname'];
$sCode=$_POST['sidiCode'];
$tCode=$_POST['taxCode'];
$body = file_get_contents("php://input");
$user = [
    '_name' => $name,
    '_surname' => $surname,
    '_sidiCode' => $sCode,
    '_tCode'=>$tCode 
];
// $js_decoded = json_decode($user, true);

$student = new Student();
$student->_name = $user["_name"];
$student->_surname = $user["_surname"];
$student->_sidiCode = $user["_sidiCode"];
$student->_taxCode = $user["_tCode"];
// $student->_name = $js_decoded["_name"];
// $student->_surname = $js_decoded["_surname"];
// $student->_sidiCode = $js_decoded["_sidiCode"];
// $student->_taxCode = $js_decoded["_taxCode"];

$js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
header("Content-Type: application/json");
echo($js_encode);

/* curl --header "Content-Type: application/json" --request POST --data '{"_name":"Ciccio", "_surname":"Benve"}' http://localhost:8080 */
?>
