<?php
if($_REQUEST==$_POST){
    $name=$_POST['name'];
    $address=$_POST['address'];
    $connection= new mysqli("localhost","root","");
    if($connection->connect_error){
        die('connection failed');
    }else{
        echo "connection successful<br>";
    }
    $sql="CREATE DATABASE IF NOT EXISTS std";
        if($connection->query($sql)==true){
            echo "Database created successfully<br>";
        }
        else
        {
            die("database not created");
        }
    $connection->close();
    $connection1=new mysqli("localhost","root","","std");
    if($connection1->connect_error){
        die('connection failed');
    }    
    else{
        echo "<br> sucessfull";
        $table="CREATE TABLE IF NOT EXISTS students(
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(20) NOT NULL,
        address VARCHAR(20) NOT NULL)";
        if($connection1->query($table)==true){
            echo "table created successfully";
            $add_sql="INSERT INTO students(name,address)
            VALUES
            ('$name','$address')";
            if($connection1->query($add_sql)==true){
                echo "value inserted successfully";
            }
        }else{
            echo "unable to create table and insert value";
        }
    }
    $connection1->close();
}else if($_REQUEST==$_GET){
    $id=$_GET['id'];
    $connection2=new mysqli("localhost","root","","std");
    if($connection2->connect_error){
        die('connection failed');
    }else{
        echo "connection sucessful<br>";
        $select="SELECT * FROM students WHERE id=$id";
        $result=$connection2->query($select);
        $parsedResult=$result->fetch_assoc();
        print_r($parsedResult);
        }
    }
else{
    echo "worng request";
}
?>