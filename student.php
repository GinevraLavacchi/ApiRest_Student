<?php
// $method = $_SERVER["REQUEST_METHOD"];
$method="PUT";
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
    $id =67;
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
    $id = 5;
    $name = 'Ginevra';
    $surname = 'Lavacchi';
    $sidi_code = '12342344';
    $tax_code = 'AAAAAAAAAAAAAAAA';
    if (isset($id, $name, $surname, $sidi_code, $tax_code)){
        $student = $student->addstudent($id, $name, $surname, $sidi_code, $tax_code);
      }else{
        echo("Dati inseriti non corretti");
      }
    $students = $student->all();
    $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  default:
    break;
}


?>
