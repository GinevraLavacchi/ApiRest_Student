<?php
$method = $_SERVER["REQUEST_METHOD"];
//$method="GET";
include('./class/Student.php');
$student = new Student();

switch($method) {
  case 'GET':
    if (isset( $_GET['id'])){
      $id= $_GET['id'];
      $student = $student->find($id);
      // $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
      $js_encode = json_encode($student);
    
    }else{
      $students = $student->all();
      // $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
      $js_encode = json_encode($students);
    }
    header("Content-Type: application/json");
    
    echo($js_encode);
    break;

  case 'POST':
    echo"post";
    $body = file_get_contents("php://input");
    $js_decoded = json_decode($body, true);
    $student = new Student();
    $student->_name = $js_decoded["name"];
    $student->_surname = $js_decoded["surname"];
    $student->_sidiCode = $js_decoded["sidi_code"];
    $student->_taxCode = $js_decoded["tax_code"];

    $result=$student->addStudent($student->_name,$student->_surname,$student->_sidiCode,$student->_taxCode);
    $js_encode = json_encode(array('state'=>TRUE, 'student'=>$result),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'DELETE':
    echo"delete";
    $id=$_GET['id'];
    //$id =5;
    if (isset($id)){
        $student->deletestudent($id);
      }else{
        $student->deleteallstudents();
      }
    $students = $student->all();
    $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'PUT':
    echo"PUT";
    $body = file_get_contents("php://input");
    $js_decoded = json_decode($body, true);
    $student = new Student();
    $student->_name = $js_decoded["name"];
    $student->_surname = $js_decoded["surname"];
    $student->_sidiCode = $js_decoded["sidi_code"];
    $student->_taxCode = $js_decoded["tax_code"];
    
    if (isset($student->_name,$student->_surname,$student->_sidiCode,$student->_taxCode)){
        $result=$student->modifyStudent($student->_name,$student->_surname,$student->_sidiCode,$student->_taxCode);
      }else{
        echo("Dati inseriti non corretti");
      }
    //$js_encode = json_encode(array('state'=>TRUE, 'students'=>$result),true);
    $js_encode = json_encode($student);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  default:
    break;
}


?>
