<?php

    $mysqli = null;

function DB_Connect()
{
global $mysqli;
global $db, $dbhost, $dbuser, $dbpass;

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);

    if ($mysqli->connect_errno) {
        // The connection failed. What do you want to do? 
        // You could contact yourself (email?), log the error, show a nice page, etc.
        // You do not want to reveal sensitive information
    
        // Let's try this:
        echo "Sorry, this website is experiencing problems.";
    
        // Something you should not do on a public site, but this example will show you
        // anyways, is print out MySQL error related information -- you might log this
        echo "Error: Failed to make a MySQL connection, here is why: \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        
        // You might want to show them something nice, but we will simply exit
        exit;
    }
}

// this function gets the list of fields in the given table
function GetFieldNamesInTable($tbl_name)
{
global $mysqli;
$fields = array();

    $result = $mysqli->query("DESCRIBE $tbl_name");
    $num_results = $result->num_results;

    for ($i = 0; $i < $num_results; $i++)
    {
        $row = $result->fetch_assoc();
        $fields[] = $row['Field'];
    }

    return $fields;
}

// this function returns an array of values that an enum field can take
// it returns false otherwise
function GetValuesForEnum($table, $column)
{
global $mysqli;

    $result = $mysqli->query("SHOW COLUMNS FROM $table WHERE Field='$column'");
    
    if ($result->num_results) {
        $row = $result->fetch_assoc();
        $Type = $row['Type'];
        
        $bracket = strpos($Type, '(');
        $close_bracket = strpos($Type, ')');

        $field_type = ($bracket !== false) ? substr($Type, 0, $bracket) : $Type;
        if ($field_type != 'enum')
            return false;
        
        $len = $close_bracket - $bracket - 1;			// determine how many characters are between the brackets
        $size = substr($Type, $bracket+1, $len);		// extract length of the column
        $size = substr($size, 1, strlen($size)-2);		// this removes the first and last quote marks
        $options = explode("','", $size);				// now spliting it gives us the values in an array
        return $options;
    }
    else return false;	
}

// this function returns an array of values that an set field can take
// it returns false otherwise
// it does the same thing as for ENUM (GetValuesForEnum)
function GetValuesForSet($table, $column)
{
global $mysqli;

    $result = $mysqli->query("SHOW COLUMNS FROM $table WHERE Field='$column'");
    
    if ($result->num_results) {
        $row = $result->fetch_assoc();
        $Type = $row['Type'];
        
        $bracket = strpos($Type, '(');
        $close_bracket = strpos($Type, ')');

        $field_type = ($bracket !== false) ? substr($Type, 0, $bracket) : $Type;
        if ($field_type != 'set')
            return false;
        
        $len = $close_bracket - $bracket - 1;			// determine how many characters are between the brackets
        $size = substr($Type, $bracket+1, $len);		// extract length of the column
        $size = substr($size, 1, strlen($size)-2);		// this removes the first and last quote marks
        $options = explode("','", $size);				// now spliting it gives us the values in an array
        return $options;
    }
    else return false;
}

function GetDefaultValuesInTable($table)
{
global $mysqli;
$defaults = array();

    $result = $mysqli->query("DESCRIBE $table");
    $num_results = $result->num_results;

    for ($i = 0; $i < $num_results; $i++)
    {
        $row = $result->fetch_assoc();
        $field = $row['Field'];
        $default = $row['Default'];
        
        if ($default != "NULL")
            $defaults[$field] = $default;
    }

    return $defaults;
}

?>
