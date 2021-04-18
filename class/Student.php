<?php
include("DBConnection.php");
class Student 
{
  private $db;
  public $_id;
  public $_name;
  public $_surname;
  public $_sidiCode;
  public $_taxCode;

  public function __construct() {
    $this->db = new DBConnection();
    $this->db = $this->db->returnConnection();
  }

  public function find($id){
    $sql = "SELECT * FROM student WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id' => $id
    ];
    $stmt->execute($data);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
  }
  public function all(){
    $sql = "SELECT * FROM student";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
  public function deletestudent ($id){
    $sql = "DELETE FROM student WHERE id='".$id."'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }
  
  public function deleteallstudents (){
    $sql = "DELETE FROM student";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }
  public function addstudent ($id, $name, $surname, $sidi_code, $tax_code){
    $sql = "INSERT INTO student(id,name,surname,sidi_code,tax_code) VALUES('".$id."','".$name."','".$surname."','".$sidi_code."','".$tax_code."')";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }
  
}
?>
