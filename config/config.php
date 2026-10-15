<?php

try {
    $host = "localhost";
    $dbname = "jobboard";
    $user = "root";
    $pass = "";
    
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo $e->getMessage();
}

    // if($conn == true) {
    //     echo "connected successfully";
    // } else {
    //     echo "error";
    // }

    define("APPURL", "http://localhost/jobboard");

    //function to insert record
    function insertRecord($conn, $table, $data){
        try{
            //1. Get the columns names
            $columns = implode(", ", array_keys($data));

            //2. Get the names placeholder as data values for columns of tables it include names
            $placeholders = ":" . implode(" , :", array_keys($data));

            //3. Construct the sql query dynamically
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

            //4. Prepare and execute the query
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);

            //5.Return true if the insertion succeeded
            return true;
        }
        catch(PDOException $e){
            //You can log this error or echo it for debugging
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }

    //function is to check email is already present in the database or not, if it is present then it will give message
    function recordExists($conn, $table, $column, $value){
        try{
            //1.Prepare a quick query to check if the value exists
            $sql = "SELECT COUNT(*) FROM $table WHERE $column = :value";
            $stmt = $conn->prepare($sql);

            //2.Safely execute using parameters
            $stmt->execute([':value' => $value]);

            //3.Fetch the total count (will be 0 if unique, or 1+ if duplicate)
            $count = $stmt->fetchColumn();

            return $count > 0; // Returns true if it exists, false if it does not
        
        } catch(PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return false;
        }
    }

    function getRecord($conn, $table, $column, $value){
        try{
            //1.Prepare a query to check if the value exists
            $sql = "SELECT * FROM $table WHERE $column = :value LIMIT 1";
            $stmt = $conn->prepare($sql);

            //2.Safely execute using parameters
            $stmt->execute([':value' => $value]);

            //3.Returns the user array if found, or false if not found
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $e){
            return false;
        }
    }
?>