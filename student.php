<?php
$method = $_SERVER["REQUEST_METHOD"];
//$method="DELETE";
include('./class/Student.php');
$student = new Student();

switch($method) {
  case 'GET':
    echo"Get";
    $id = $_GET['id'];
    if (isset($id)&& $id!=""){
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }else{
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    }
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'POST':
    echo"post";
    $id = $_POST['id'];
    if (isset($id)&& $id!=""){
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }else{
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    }
    header("Content-Type: application/json");
    echo($js_encode);
    // TODO
    break;

  case 'DELETE':
    // TODO
    echo"delete";
    $id =2;
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
    // TODO
    echo"PUT";
    $id = 2;
    $name = 'Ginevra';
    $surname = 'Lavacchi';
    $sidi_code = '12342310';
    $tax_code = 'AAAAAAAAAAAAAAA';
    if (isset($id, $name, $surname, $sidi_code, $tax_code)){
        $student->addstudent($id, $name, $surname, $sidi_code, $tax_code);
      }else{
        echo("Dati inseriti non corretti");
      }
    $student = $student->all();
    $js_encode = json_encode(array('state'=>TRUE, 'students'=>$student),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  default:
    break;
}


?>
