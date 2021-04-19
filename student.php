<?php
$method = $_SERVER["REQUEST_METHOD"];
//$method="GET";
if($method=="POST")
{
  $method=$_POST["_method"];
}
include('./class/Student.php');
$student = new Student();

switch($method) {
  case 'GET':
    //*echo"Get";
    //$id = $_GET['id'];
    $id=67;
    if (isset($id)&& $id!=""){
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }else{
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    }
    header("Content-Type: application/json");
    echo($js_encode);
    return("ciao");
    break;

  case 'POST':
    echo"post";
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $sCode=$_POST['sidi_code'];
    $tCode=$_POST['tax_code'];
    $body = file_get_contents("php://input");
    $student = new Student();
    $student->_name = $name;
    $student->_surname = $surname;
    $student->_sidiCode = $sCode;
    $student->_taxCode = $tCode;
    $result=$student->addStudent($name,$surname,$sCode,$tCode);
    $js_encode = json_encode(array('state'=>TRUE, 'student'=>$result),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'DELETE':
    echo"delete";
    $id =5;
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
    $id=$_POST['idPut'];
    $name=$_POST['namePut'];
    $surname=$_POST['surnamePut'];
    $sCode=$_POST['sidi_codePut'];
    $tCode=$_POST['tax_codePut'];
    // $id=12352;
    // $name='Ginevra';
    // $surname='Lavacchiii';
    // $sCode='1000000000000';
    // $tCode='1000000000000';
    $body = file_get_contents("php://input");
    $student = new Student();
    $student->_id = $id;
    $student->_name = $name;
    $student->_surname = $surname;
    $student->_sidiCode = $sCode;
    $student->_taxCode = $tCode;
    if (isset($id, $name, $surname, $sCode, $tCode)){
        $result=$student->modifyStudent($id, $name, $surname, $sCode, $tCode);
      }else{
        echo("Dati inseriti non corretti");
      }
    $js_encode = json_encode(array('state'=>TRUE, 'students'=>$result),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  default:
    break;
}


?>
