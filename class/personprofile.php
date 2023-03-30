<?php

class PersonProfile{

    // database connection and table name
    private $conn;
    private $table_name = "personprofile";

    public $profileid;
    public $firstname;
    public $lastname;
    public $gender;
    public $age;
    public $mobile;
    public $temp;
    public $diag;
    public $enc;
    public $vax;
    public $nat;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getbyid($params){
        mysqli_next_result($this->conn);;
        $sql = "SELECT * FROM " . $this->table_name . " WHERE profileid = " . $params;

        $result = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return $result;
    }

    public function getall($params){
        $sql = "SELECT COUNT(*) AS count FROM " . $this->table_name . " WHERE firstname LIKE '" . $params->search ."' OR lastname LIKE '" . $params->search ."'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        mysqli_next_result($this->conn);
   
        $sql = "SELECT * FROM " . $this->table_name . " WHERE firstname LIKE '" . $params->search ."' OR lastname LIKE '" . $params->search ."' LIMIT " . $params->start . ", " . $params->length;
        $result = mysqli_query($this->conn, $sql);
        $result->recordsTotal = $row['count'];
        mysqli_close($this->conn);

        return $result;
        // mysqli_next_result($this->conn);
        // $sql = "SELECT * FROM " . $this->table_name . " WHERE firstname LIKE '%" . $searchtext . "%' OR lastname LIKE '%" . $searchtext . "%' LIMIT 10";

        // $result = mysqli_query($this->conn, $sql);
        // mysqli_close($this->conn);
        // return $result;
    }

    public function create(){
        $statement = $this->conn->prepare("INSERT INTO " . $this->table_name . " (firstname, lastname, gender, age, mobile, temp, diag, enc, vax, nat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("ssssssssss",$this->firstname,$this->lastname,$this->gender,$this->age,$this->mobile,$this->temp,$this->diag,$this->enc,$this->vax,$this->nat);

        //sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->temp=htmlspecialchars(strip_tags($this->temp));
        $this->diag=htmlspecialchars(strip_tags($this->diag));
        $this->enc=htmlspecialchars(strip_tags($this->enc));
        $this->vax=htmlspecialchars(strip_tags($this->vax));
        $this->nat=htmlspecialchars(strip_tags($this->nat));

        if($statement->execute()){
            $statement->close();
            return true;
        }

        echo ("Error: " . $this->conn->error);
        return false;
    }

    public function update(){
        $statement = $this->conn->prepare("UPDATE " . $this->table_name . " SET firstname = ?, lastname = ?, gender = ?, age = ?, mobile = ?, temp = ?, diag = ?, enc = ?, vax = ?, nat = ? WHERE profileid = " . $this->profileid . "");
        $statement->bind_param("ssssssssss",$this->firstname,$this->lastname,$this->gender,$this->age,$this->mobile,$this->temp,$this->diag,$this->enc,$this->vax,$this->nat);

        //sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->temp=htmlspecialchars(strip_tags($this->temp));
        $this->diag=htmlspecialchars(strip_tags($this->diag));
        $this->enc=htmlspecialchars(strip_tags($this->enc));
        $this->vax=htmlspecialchars(strip_tags($this->vax));
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
        $sql = "SELECT * FROM v_dashboarddata";

        $result = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return $result;
    }




}

?>