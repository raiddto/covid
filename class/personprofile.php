<?php

class PersonProfile{

    // database connection and table name
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $gender;
    public $age;
    public $mobile;
    public $temp;
    public $diag;
    public $enc;
    public $vac;
    public $nat;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getbyid($params){
        mysqli_next_result($this->conn);;
        $sql = "SELECT * FROM " . $this->table_name . " WHERE id = " . $params;

        $result = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return $result;
    }

    public function getall($searchtext){
        mysqli_next_result($this->conn);;
        $sql = "SELECT * FROM " . $this->table_name . " WHERE name LIKE '%" . $searchtext . "%'";

        $result = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return $result;
    }

    public function create(){
        $statement = $this->conn->prepare("INSERT INTO " . $this->table_name . " (name, gender, age, mobile, temp, diag, enc, vac, nat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("sssss",$this->name,$this->gender,$this->age,$this->mobile,$this->temp,$this->diag,$this->enc,$this->vac,$this->nat);

        //sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->temp=htmlspecialchars(strip_tags($this->temp));
        $this->diag=htmlspecialchars(strip_tags($this->diag));
        $this->enc=htmlspecialchars(strip_tags($this->enc));
        $this->vac=htmlspecialchars(strip_tags($this->vac));
        $this->nat=htmlspecialchars(strip_tags($this->nat));

        if($statement->execute()){
            $statement->close();
            return true;
        }

        echo ("Error: " . $this->conn->error);
        return false;
    }

    public function update(){
        $statement = $this->conn->prepare("UPDATE " . $this->table_name . " SET name = ?, gender = ?, age = ?, gender = ?, mobile = ?, address = ?, temp = ?, diag = ?, enc = ?, vac = ?, nat = ? WHERE profileid = " . $this->profileid . "");
        $statement->bind_param("sssss",$this->name,$this->gender,$this->age,$this->gender,$this->mobile,$this->temp,$this->diag,$this->enc,$this->vac,$this->nat);

        //sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->temp=htmlspecialchars(strip_tags($this->temp));
        $this->diag=htmlspecialchars(strip_tags($this->diag));
        $this->enc=htmlspecialchars(strip_tags($this->enc));
        $this->vac=htmlspecialchars(strip_tags($this->vac));
        $this->nat=htmlspecialchars(strip_tags($this->nat));

        if($statement->execute()){
            $statement->close();
            return true;
        }

        echo ("Error: " . $this->conn->error);
        return false;
    }

    public function delete(){
        $statement = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE profileid = " . $this->profileid);

        if($statement->execute()){
            $statement->close();
            return true;
        }

        echo ("Error: " . $this->conn->error);
        return false;
    }

    public function getdashboarddata() {
        mysqli_next_result($this->conn);;
        $sql = "SELECT COUNT(*) AS numofprofiles FROM " . $this->table_name;

        $result = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return $result;
    }




}

?>