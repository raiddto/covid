<?php

class PersonProfile{

    // database connection and table name
    private $conn;
    private $table_name = "personprofile";

    public $profileid;
    public $firstname;
    public $lastname;
    public $middlename;
    public $gender;
    public $address;

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

    public function getall($searchtext){
        mysqli_next_result($this->conn);;
        $sql = "SELECT * FROM " . $this->table_name . " WHERE firstname LIKE '%" . $searchtext . "%' OR lastname LIKE '%" . $searchtext . "%'";

        $result = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return $result;
    }

    public function create(){
        $statement = $this->conn->prepare("INSERT INTO " . $this->table_name . " (firstname, lastname, middlename, gender, address) VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param("sssss",$this->firstname,$this->lastname,$this->middlename,$this->gender,$this->address);

        //sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->middlename=htmlspecialchars(strip_tags($this->middlename));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->address=htmlspecialchars(strip_tags($this->address));

        if($statement->execute()){
            $statement->close();
            return true;
        }

        echo ("Error: " . $this->conn->error);
        return false;
    }

    public function update(){
        $statement = $this->conn->prepare("UPDATE " . $this->table_name . " SET firstname = ?, lastname = ?, middlename = ?, gender = ?, address = ? WHERE profileid = " . $this->profileid . "");
        $statement->bind_param("sssss",$this->firstname,$this->lastname,$this->middlename,$this->gender,$this->address);

        //sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->middlename=htmlspecialchars(strip_tags($this->middlename));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->address=htmlspecialchars(strip_tags($this->address));

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