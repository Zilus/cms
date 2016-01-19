<?php
session_start(); 
include('includes/globals.php');
include('includes/functions.php');
include('includes/redirects.php');
include('includes/kick.php');
include('lib/database.class.php');

$database = new Database();
//catch error;
echo $database->errorInfo();

//insert
$sql="INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)";
$database->query($sql);
$database->bind(':fname', 'John');
$database->bind(':lname', 'Smith');
$database->bind(':age', '24');
$database->bind(':gender', 'male');

//$database->execute();
//echo $database->lastInsertId();

//insert array
$sql="INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)";
$database->query($sql);
$database->bindArray(array(
	':fname' => 'Maria2',
	':lname' => 'Azpeitia',
	':age' => 26,
	':gender' => 'female'
));
//$database->execute();


//multiple
$database->beginTransaction();
$sql="INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)";
$database->query($sql);
$database->bind(':fname', 'Jenny');
$database->bind(':lname', 'Smith');
$database->bind(':age', '23');
$database->bind(':gender', 'female');
//$database->execute();

$database->bind(':fname', 'Jilly');
$database->bind(':lname', 'Smith');
$database->bind(':age', '25');
$database->bind(':gender', 'female');
//$database->execute();

$database->bind(':fname', 'Maria');
$database->bind(':lname', 'Azpeitia');
$database->bind(':age', '26');
$database->bind(':gender', 'female');
//$database->execute();

echo $database->lastInsertId();
//$database->endTransaction();

//select
$sql="SELECT FName, LName, Age, Gender FROM mytable WHERE FName = :fname";
$database->query($sql); 
$database->bind(':fname', 'Jenny');
$row = $database->single();
echo "<pre>";
print_r($row);
echo "</pre>";

//multiple
$sql="SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname";
$database->query($sql);
$database->bind(':lname', 'Smith');
$rows = $database->resultset();
echo "<pre>";
print_r($rows);
echo "</pre>";
echo $database->rowCount();

//update
$UserID = 14;
$sql="UPDATE mytable SET FName = :fname, LName = :lname WHERE ID = :Userid";
$database->query($sql);
$database->bind(':Userid', $UserID); 
$database->bind(':fname', 'Maria');
$database->bind(':lname', 'de Azpeitia'); 
$database->execute();

$UserID = 14;
$sql="UPDATE mytable SET FName = :fname, LName = :lname, Age = :age, Gender = :gender WHERE ID = :Userid";
$database->query($sql);
$database->bindArray(array(
':Userid' => $UserID,
':fname' => 'Maria',
':lname' => 'de de Azpeitia',
':age' => 23,
':gender' => 'female'
));
$database->execute();

$database->query('SELECT * FROM mytable WHERE ID= :Userid');
$database->bind(':Userid',$UserID);
$rows = $database->resultset();
echo '<pre>'; print_r($rows); echo "</pre>";

//delete
$UserID = 14;
$sql="DELETE FROM mytable WHERE ID = :Userid";
$database->query($sql);
$database->bind(':Userid', $UserID); 
$database->execute();
?>