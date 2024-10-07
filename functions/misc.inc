<?php

function LocalForward($relative_url)
{
    header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $relative_url);
}


function Redirect($absolute_url)
{
    header("Location: http://" . $_SERVER['HTTP_HOST'] . $absolute_url);
}

function EscapeQuotes($array)
{
    foreach($array as $key => $value)
        $array[$key] = addslashes($value);

    return $array;
}

function TrimQuotedString($string) {
    if ($string[0] == '"' && $string[-1] == '"') {
        return trim($string, '"');
    }
    
    return $string;
}

// builds list of options for a dropdown menu
function BuildOptionsList($list, $default)
{
    $options = "";
    foreach ($list as $id => $value)
    {
        $selected = ($id == $default) ? 'selected' : '';
        $options .= "<option value=\"$id\" $selected>$value</option>\r\n";
    }
    return $options;
}

// handles uploading of a file.
// NOTE: $destination must contain the filename also
function HandleUploadFile($field, $destinaton)
{
    if (isset($_FILES[$field]) && $_FILES[$field]['size'])
    {
        if (move_uploaded_file($_FILES[$field]['tmp_name'], $destinaton))
            return true;
        else return false;
    }
    else
    {
        print 'no file';		// no file was uploaded
        return false;
    }
}

function AbsolteURL($page_url, $url) {
    if (strpos($url,'://')) { 										// already absolute
        return $url;
    }
    
    if (substr($url,0,2) == '//') {									// shorthand scheme
        return 'http:'.$url;
    }

    if ($url[0]=='/') {												// just add domain
        return parse_url($page_url, PHP_URL_SCHEME)
            .'://'.parse_url($page_url, PHP_URL_HOST)
            .$url;
    }

    if (strpos($page_url, '/', 9) === false) {						// add slash to domain if needed
        $page_url .= '/';
    }
    
    return substr($page_url, 0, strrpos($page_url,'/')+1).$url; 	//for relative links, gets current directory and appends new filename
}

function NoDots($path) {
    $arr1 = explode('/', $path);
    $arr2 = array();
    
    foreach($arr1 as $seg) {
        switch($seg) {
        case '.':
            break;
        
        case '..':
            array_pop($arr2);
            break;

        case '...':
            array_pop($arr2); array_pop($arr2);
            break;

        case '....':
            array_pop($arr2); array_pop($arr2); array_pop($arr2);
            break;

        case '.....':
            array_pop($arr2); array_pop($arr2); array_pop($arr2); array_pop($arr2);
            break;

        default:
            $arr2[] = $seg;
        }
    }
    return implode('/',$arr2);
}

// $dir is absolute
// filename is returned without path
function GetFileForBaseName($basename, $dir)
{
    $open = opendir($dir);

    while (($filename = readdir($open)) !== false)
    {
        if (preg_match("/^$basename\./", $filename))		// we use \. to look for "image1.". it blocks off "image12" etc
            $file = $filename;
    }

    if (!$file)
        return false;
    else return $file;
}

function email($from_name, $from_email, $recipient, $return_path, $subject, $message, $bcc=false)
{
    $message .= "\r\n";

    /* additional header pieces for errors, From, cc's, bcc's, etc */
    $headers  = "From: ". $from_name . " <". $from_email . ">\r\n";

    if ($bcc == true) {
        $headers .= "Bcc: satya.dayanand@gmail.com\r\n";
    }
    
    $headers .= "Content-Type: text/html; charset=utf-8\r\n"; // we want html formatted emails
    
    /* and now mail it */
    mail($recipient, $subject, $message, $headers);
//	SendMail($from_name, $from_email, $recipient, $return_path, $subject, $message);

/* for test */
//	print "<pre>\n";
//	print "$from_name, $from_email<br>";
//	print "$subject<br>";
//	print "$message<br>";
//	print "</pre><br>";
//	exit;
}

function SendMail($from_name, $from_email, $recipient, $return_path, $subject, $message)
{
    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
    
    set_include_path("." . PATH_SEPARATOR . ($userDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
    require_once "Mail.php";
    
    $host = "ssl://homie.mail.dreamhost.com";
    $username = "orders@cottageindustries.co.in";
    $password = "F5Kc7YW2";
    $port = "465";
    $bcc = "satya.dayanand@gmail.com";
    
     $recipient .= ", $bcc";
    
    $headers = array (
        'From' => $from_email, 
        'To' => $recipient, 
        'Subject' => $subject, 
        'Reply-To' => $from_email, 
        'MIME-Version' => 1,
        'Content-type' => 'text/html; charset=utf-8'
    );
    $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
    $mail = $smtp->send($recipient, $headers, $message);
    
    
    if (PEAR::isError($mail)) {
// 		echo("<p>" . $mail->getMessage() . "</p>");
    } else {
// 		echo("<p>Message successfully sent!</p>");
    }
}

function GetAvatarForEntity($entity, $id) {
global $TS_PARAMS;

    $target_dir = $TS_PARAMS['docroot'] . "uploads/avatars/";
    $target_file = "{$target_dir}{$entity}_{$id}";
    $result = glob("$target_file.*");
    
    if (count($result) > 0) {
        $target_file = str_replace($TS_PARAMS['docroot'], '/', $result[0]);
    } else {
        $target_file = "/assets/img/default-avatar.png";
    }
    
    return $target_file;
}

function SaveAvatarForEntity($entity, $id) {
global $TS_PARAMS;

    $target_dir = $TS_PARAMS['docroot'] . "uploads/avatars/";
    $image_name =  $target_dir . basename($_FILES["avatar_upload"]["name"]);
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $target_file = "{$target_dir}{$entity}_{$id}.{$image_ext}";
    
    $allowd_file_ext = array("jpg", "jpeg", "png");

    if (!file_exists($_FILES["avatar_upload"]["tmp_name"])) {
       $resMessage = array(
           "status" => "alert-danger",
           "message" => "Select image to upload."
       );
    } else if (!in_array($image_ext, $allowd_file_ext)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Allowed file formats .jpg, .jpeg and .png."
        );            
    } else if ($_FILES["avatar_upload"]["size"] > 2097152) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File is too large. File size should be less than 2 megabytes."
        );
    } else if (file_exists($target_file)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File already exists."
        );
    } else {
        if (move_uploaded_file($_FILES["avatar_upload"]["tmp_name"], $target_file)) {
            $resMessage = array(
                "status" => "alert-success",
                "message" => "Image uploaded successfully."
            );                 
        } else {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Image coudn't be uploaded."
            );
        }
    }
}

function GetImageForIssue($issue_id) {
global $TS_PARAMS;

    $target_dir = $TS_PARAMS['docroot'] . "uploads/issues/";
    $target_file = "{$target_dir}issue_{$issue_id}";
    $result = glob("$target_file.*");
    
    if (count($result) > 0) {
        $target_file = str_replace($TS_PARAMS['docroot'], '/', $result[0]);
    } else {
        $target_file = "/images/image_placeholder.png";
    }
    
    return $target_file;
}

function SaveUploadedImageForIssue($id) {
global $TS_PARAMS;

    $target_dir = $TS_PARAMS['docroot'] . "uploads/issues/";
    $image_name =  $target_dir . basename($_FILES["image_upload"]["name"]);
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $target_file = "{$target_dir}issue_{$id}.{$image_ext}";
    
    $allowd_file_ext = array("jpg", "jpeg", "png");

    if (!file_exists($_FILES["image_upload"]["tmp_name"])) {
       $resMessage = array(
           "status" => "alert-danger",
           "message" => "Select image to upload."
       );
    } else if (!in_array($image_ext, $allowd_file_ext)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Allowed file formats .jpg, .jpeg and .png."
        );            
    } else if ($_FILES["avatar_upload"]["size"] > 2097152) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File is too large. File size should be less than 2 megabytes."
        );
    } else if (file_exists($target_file)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File already exists."
        );
    } else {
        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
            $resMessage = array(
                "status" => "alert-success",
                "message" => "Image uploaded successfully."
            );                 
        } else {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Image coudn't be uploaded."
            );
        }
    }
    
    return $target_file;
}

function SaveUploadedImageB64ImageForIssue($id, $base64DataString) {
global $TS_PARAMS;

    $target_dir = $TS_PARAMS['docroot'] . "uploads/issues/";
    $target_file = "{$target_dir}issue_{$id}.jpg";
    
    $pattern = '/data:image\/(.+);base64,(.*)/';									// extract image data from base64 data string
    preg_match($pattern, $base64DataString, $matches);

    $imageExtension = $matches[1];													// image file extension
    $encodedImageData = $matches[2];												// base64-encoded image data
    $decodedImageData = base64_decode($base64DataString);							// decode base64-encoded image data

    file_put_contents($target_file, $decodedImageData);								// save image data as file
}

function DeleteUploadedImageFoIssue($issue_id) {
global $TS_PARAMS;

    $target_dir = $TS_PARAMS['docroot'] . "uploads/issues/";
    $target_file = "{$target_dir}issue_{$issue_id}";
    $result = glob("$target_file.*");
    
    if (count($result) > 0) {
        $target_file = $result[0];
        unlink($target_file);
    }
}

function CorrectImageOrientation($filename) {
    if (function_exists('exif_read_data')) {
        $exif = exif_read_data($filename);
    
        if ($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            
            if ($orientation != 1) {
                $img = imagecreatefromjpeg($filename);
                $deg = 0;
                
                switch ($orientation) {
                case 3:
                    $deg = 180;
                    break;
                case 6:
                    $deg = 270;
                    break;
                case 8:
                    $deg = 90;
                    break;
                }
        
                if ($deg) {
                    $img = imagerotate($img, $deg, 0);        
                }
        
                // then rewrite the rotated image back to the disk as $filename 
                imagejpeg($img, $filename, 95);
            } // if there is some rotation necessary
        } // if have the exif orientation info
    } // if function exists      
}

function ColorFromSeverity($severity) {
    switch($severity) {
        case 'A':
            return 'danger';
        case 'B':
            return 'warning';
        case 'C':
            return 'success';
    }
}

function GetImagesInDir($dir)
{
$images = array();

    $open = opendir($dir);
    while (($filename = readdir($open)) !== false)
    {
        if ($file != "." && $file != "..")
            $images[] = $filename;
    }

    if (count($images))
        sort($images);

    array_shift($images);
    array_shift($images);

    return $images;
}

// get number of files in dir $dir
function CountFiles($dir)
{
$count = 0;
    if (file_exists($dir))
    {
        $handle = opendir($dir);
        while (false !== ($file = readdir($handle)))
        {
            if ($file != "." && $file != "..")
                $count++;
        }
        closedir($handle);
    }
    return $count;
}

// this function get the maximum index and next next index
// parameters:
// $rm_start : remove from start (ex. 5 for image4.jpg)
// $rm_end : remove from end (ex. 4 for image4.jpg)
// returns new index that can be used
function GetMaxIndexInFolder($dir, $rm_start, $rm_end)
{
    $images = GetImagesInDir($dir);
    $max = 0;
    for ($i = 0; $i < count($images); $i++)
    {
        $index = substr($images[$i], $rm_start);
        $index = substr($index, 0,-$rm_end);
        if ($index > $max)
            $max = $index;
    }
    return $max+1;
}

/** 
* Empty folder (recursively) 
* 
* @autor Hatem <http://hatem.phpmagazine.net> 
* @param string        $folder        Folder name (without trailing slash) 
* @param boolean    $debug        print debug message 
* @return void 
*/ 
function EmptyFolder($folder, $debug=false)
{ 
    if ($debug)
    { 
        echo "Cleaning folder $folder ... <br>"; 
    } 
    
    $d = dir($folder); 
    
    while (false !== ($entry = $d->read()))
    { 
        $isdir = is_dir($folder."/".$entry); 
        
        if (!$isdir && $entry != "." && $entry != "..")
        {
            unlink($folder."/".$entry); 
        }
        elseif ($isdir && $entry != "." && $entry != "..")
        {
            EmptyFolder($folder."/".$entry,$debug); 
            rmdir($folder."/".$entry); 
        } 
    } 
    $d->close(); 
}

// this function recursively removes a directory
function RemoveDirectory($path)
{
    $dp = opendir($path);
    while (false != ($file = readdir($dp)))
    {
        if ($file != "." && $file != "..")
        {
            if (is_file("$path/$file"))
                @unlink("$path/$file");				// delete file
            else
            {
                RemoveDirectory("$path/$file");		// empty the folder
                @rmdir("$path/$file");				// delete the folder
            }
        }
    }
    @rmdir($path);
}

// this function iterates through a directory ($dir)
// and generates an array ($listings) with 2 parts:
// $listings['files'] containing an array of all files (with path) in the directory
// $listings['directories'] containing an array of all subdirectories (with path) in the directory
function GetDirectoryListing($dir, &$listings)
{
    $dp = opendir($dir);
    while (false != ($file = readdir($dp)))
    {
        if ($file!="." && $file!="..")
        {
            if (is_dir("$dir/$file"))
            {
                GetDirectoryListing("$dir/$file", $listings);
                $listings['directories'][] = "$dir/$file";			// add dir to $listings['directories'] array
            }
            else $listings['files'][] = "$dir/$file";				// add file to $listings['files'] array
        }
    }
}

function SanitiseUserInput($input)
{
global $mysqli;
    
   // if (get_magic_quotes_gpc())									   // Stripslashes
   // {
   //     $input = stripslashes($input);
   // }
   
   $input = trim($input);
   $input = $mysqli->real_escape_string($input);
   
   return $input;
}

function GenerateBreadCrumb($id, $glue)
{
    $ancestors = GetAncestorsForID($id);
    $nodes = array ("<a href=\"/products/index.php\">Products</a>");

    $numnodes = count($ancestors);

// last node should not be a link
    for ($i = 0; $i < $numnodes - 1; $i++)
    {
        $nodes[] = "<a href=\"" . $ancestors[$i]['url'] . "\">" . $ancestors[$i]['title'] . "</a>";

    }
    $nodes[] = $ancestors[$numnodes - 1]['title'];

    $string = join($glue, $nodes);

    return $string;
}

function ValidateEmail($adr)
{
    $result = preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)*\.\w{2,8}$/', $adr) == true;

    return $result;
}

function ValidatePin($pin)
{
    $result = preg_match('/[^0-9]+/', $pin) == false;

    return $result;
}

function FormattedWeightRangeFromString($range) {
    list($starting_weight, $ending_weight) = explode('..', $range);
        
    if ((int)$starting_weight >= 1000) {
        $unit1 = 'Kg';
        $starting_weight = $starting_weight / 1000;
    } else {
        $unit1 = 'g';
    }
    
    if ((int)$ending_weight >= 1000) {
        $unit2 = 'Kg';
        $ending_weight = $ending_weight / 1000;
    } else {
        $unit2 = 'g';
    }
    
    if ($unit1 == $unit2) {
        $formatted_range = "$starting_weight..{$ending_weight}{$unit2}";
    } else {
        $formatted_range = "$starting_weight{$unit1}..{$ending_weight}{$unit2}";
    }

    return $formatted_range;
}

// converts minutes to HH:MM. Used in time tracker
function GetFomattedDuration($duration)
{
    if (!$duration)
        return "";

    $hours = (int)($duration / 60);
    $mins = $duration - ($hours * 60);
    $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $mins = str_pad($mins, 2, '0', STR_PAD_LEFT);

    return "$hours:$mins";
}

// ex: February, 2005
function FormatDateAsMonthYear($monthnum, $year)
{
    return date("F", mktime(0, 0, 0, $monthnum, 1, 1)) . ", $year";
}

// Takes a date formatted as 21/2/2005 and returns '2005-02-21' or NULL
function DateToMySQLDate($date)
{
    if ($date == '')
        return 'NULL';
    
    $date = date("Y-m-d", strtotime($date));
    
    return "'$date'";
}

function MySQLDateToDate($date)
{
    if ($date == '')
        return '';

    return date("m/d/Y", strtotime($date));
}


// Takes a date formatted as 21/2/2005 and returns 2005-02-21
function FormatMySQLDate($date)
{
    if ($date == '')
        return '';

    list($d, $m, $y) = explode('/', $date);
    $date = join('/', array($m, $d, $y));
    return date("Y-m-d", strtotime($date));
}

function FormatMySQLDateTime($date)
{
    if ($date == '')
        return '';

    list($d, $m, $y) = explode('/', $date);
    $date = join('/', array($m, $d, $y));
    return date("Y-m-d H:i:s", strtotime($date));
}

// ex: 23 Sep, 05:25 AM
function FormatDateTime($inDate)
{
    if (!$inDate)
        return '';

    return date("d M, h:i A", $inDate);
}

// returns full name of month, i.e. January, February
function GetMonthName($m)
{
$names = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    if ($m > 0 && $m < 13)
        return $names[$m];
    else return false;
}

// 17/08/2006
function GetFormattedDate($inDate, $friendly=true)
{
    if ($inDate == '' || $inDate == '0000-00-00')
        return '';

    $today = date("d/m/Y");
    if (strtotime($inDate))
        $outDate = date("d/m/Y", strtotime($inDate));
    else $outDate = '';

    if ($friendly && $today == $outDate)
        return "Today";
    else return $outDate;
}

// Thu 17 Aug 2006
function GetFormattedDate1($inDate, $friendly=true)
{
    if ($inDate == '')
        return '';

    $today = date("d/m/Y");
    $outDate = date("D d M Y", strtotime($inDate));

    if ($friendly && $today == $outDate)
        return "Today";
    else return $outDate;
}

// Thu, Aug 17
function GetFormattedDate2($inDate, $friendly=true)
{
    if ($inDate == '')
        return '';

    $today = date("d/m/Y");
    $outDate = date("D, M d", strtotime($inDate));

    if ($friendly && $today == $outDate)
        return "Today";
    else return $outDate;
}

function GetFormattedTime($inTime)
{
    if ($inTime == '')
        return '';

    $outTime = date("h:i A", strtotime($inTime));

    return $outTime;
}

function ConvertToHours($duration)
{
    $mins = $duration % 60;
    $hours = ($duration - $mins) / 60;

    $new_duration = "";
    if ($hours)
        $new_duration .= $hours . " hours";
    if ($mins)
        $new_duration .= " " . $mins . " mins";

    return $new_duration;
}

/**
 * convert long integer into American or Indian English words.
 * e.g. -12345 -> "minus twelve thousand forty-five"
 * Handles negative and positive integers
 * on range -Long.MAX_VALUE .. Long.MAX_VALUE;
 * It cannot handle Long.MIN_VALUE;
 *
 * takes two parameters:
 * $num - number to convert to words
 * $currency - 'USD' or 'INR' words to convert to
 */
function num2words($num, $currency)
{
    $ZERO = "zero";
    $MINUS = "minus";
    $lowName = array(
         /* zero is shown as "" since it is never used in combined forms */
         /* 0 .. 19 */
         "", "One", "Two", "Three", "Four", "Five",
         "Six", "Seven", "Eight", "Nine", "Ten",
         "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen",
         "Sixteen", "Seventeen", "Eighteen", "Nineteen");

    $tys = array(
         /* 0, 10, 20, 30 ... 90 */
         "", "", "Twenty", "Thirty", "Forty", "Fifty",
         "Sixty", "Seventy", "Eighty", "Ninety");

    switch ($currency)
    {
    case 'USD': 	$groupName = array(
                    // American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion
                    "", "Hundred", "Thousand", "Million", "Billion", "Trillion", "Quadrillion", "Quintillion");

                      $divisor = array(
                    // How many of this group is needed to form one of the succeeding group.
                    // American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion
                    100, 10, 1000, 1000, 1000, 1000, 1000, 1000) ;
                    break;

    case 'INR': 	$groupName = array(
                    // Indian: unit, hundred, thousand, lakh, crore
                     "", "Hundred", "Thousand", "Lakh", "Crore");

                    $divisor = array(
                    // How many of this group is needed to form one of the succeeding group.
                    // Indian: unit, hundred, thousand, lakh, crore
                     100, 10, 100, 100) ;
                     break;

    case 'Paise': 	$groupName = array();
                    $divisor = array(100);
                    break;
    }
    $num = str_replace(",","",$num);
    $num = number_format($num,2,'.','');
    $cents = substr($num,strlen($num)-2,strlen($num)-1);
    $num = (int)$num;

    $s = "";

    if ( $num == 0 ) $s = $ZERO;
    $negative = ($num < 0 );
    if ( $negative ) $num = -$num;

    // Work least significant digit to most, right to left.
    // until high order part is all 0s.
    for ( $i=0; $num>0; $i++ )
    {
        $remdr = (int)($num % $divisor[$i]);
        $num = $num / $divisor[$i];

        if ( $remdr == 0 )
            continue;

        $t = "";
        if ( $remdr < 20 )
            $t = $lowName[$remdr];
        else if ( $remdr < 100 )
        {
            $units = (int)$remdr % 10;
            $tens = (int)$remdr / 10;
            $t = $tys [$tens];
            if ( $units != 0 )
                $t .= " " . $lowName[$units];
        }
        else
            $t = $inWords[$remdr];

        $s = $t . " " . $groupName[$i] . " "  . $s;
        $num = (int)$num;
    }

    $s = trim($s);
    if ( $negative )
        $s = $MINUS . " " . $s;

    switch($currency)
    {
    case 'USD':		$s = "USD " . $s . " and $cents/100";
                     break;

    case 'INR':		$s .= " Rupees";
                    if ($cents != '00')
                        $s .= " and " . num2words($cents, 'Paise');

                    $s .= " Only";
                    break;

    case 'Paise':	$s .= " Paise";
    }

    return $s;
}

function HandleExpiredSession()
{
     $name   = 'session_timer';											// we are handling expired cookies ourselves
     $value  = time() + 1500;											// session expires in 25 min.

     $session_timer = $_COOKIE["$name"];

    if (isset($session_timer) && $session_timer < time())				// session has expired
    {
        ResetSession();
        ShowExpiredSession();
    }
     else setcookie($name, $value, time() + 2592000, '/');				// set new value for session timer cookie expiring in 30 days
}

function ExpiredSession()
{
     $name   = 'session_timer';											// we are handling expired cookies ourselves
     $value  = time() + 1500;											// session expires in 15 min.

     $session_timer = $_COOKIE["$name"];

    if (isset($session_timer) && $session_timer < time())				// session has expired
    {
        ResetSession();
        return true;
    }
     else setcookie($name, $value, time() + 2592000, '/');				// set new value for session timer cookie
     return false;
}

function ResetSession()
{
     $name   = 'session_timer';											// we are handling expired cookies ourselves
    setcookie($name, '');												// delete cookie
    session_unset();
}

function ShowExpiredSession()
{
    $expired_url = "expired.html";
    include($expired_url);
    exit;
}

function RoundOff($amount, $thresh=100)
{
    $integer = (int)$amount;
    $decimal = $amount - $integer;

    switch($thresh)
    {
    case 25:	if ($decimal < .125)
                    $decimal = 0;
                else if ($decimal < .375)
                    $decimal = .25;
                else if ($decimal < .675)
                    $decimal = .50;
                else if ($decimal < .875)
                    $decimal = .75;
                else
                {
                    $integer++;
                    $decimal = 0;
                }
                break;

    case 50:	if ($decimal < .25)
                    $decimal = 0;
                else if ($decimal < .75)
                    $decimal = .50;
                else
                {
                    $integer++;
                    $decimal = 0;
                }
                break;

    case 100:	$decimal = 0;
                if ($decimal > .50)
                    $integer++;
    }
//	print $integer + $decimal; exit;
    return $integer + $decimal;
}

function PaginateResults($per_page, $start, $num_rows, &$from, &$to, &$page_nav)
{
    if ($per_page <= 0)					// per_page has to be a non zero positive int.
        return '';

    $from = $start + 1;
    $to = $num_rows > $start + $per_page ? $start + $per_page : $num_rows;

    $pagination_str = "Showing $from - $to of $num_rows";

    $num_pages = (int)$num_rows / 20 + 1;
    $num_pages = $num_pages < 10 ? $per_page : 10;

    if ($num_pages > 1)
    {
        for ($i = 1; $i < $num_pages; $i++)
        {
            $page_start = ($i - 1) * 20;

            if ($page_start != $row_start)
                $pages[] = "<a href=\"$PHP_SELF?view=$view&start=$page_start\">$i</a>";
            else $pages[] = "<b>$i</b>";
        }
        $page_nav = join(' ', $pages);
    }

    return $pagination_str;
}

function AppendSuffixToFilename($filename, $suffix)
{
    $tokens = explode(".", $filename);
    if (count($tokens) == 1)
        return $tokens[0] . "_" . $suffix;

    $str = "";
    for ($i = 0; $i < count($tokens)-1; $i++)
        $str .= $tokens[$i];

    return $str . "_" . $suffix . "." . $tokens[count($tokens)-1];
}

function HyphenateString($in_str)
{
    $pattern = array('/[\'\.]/', '/[^a-zA-Z0-9]+/');
    $replace = array('', '-');
    
    return preg_replace($pattern, $replace, $in_str);
}

function FilenameFromString($string) {
    return preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $string);
}

function readfile_chunked($filename, $retbytes=true)
{ 
   $chunksize = 1*(1024*1024); // how many bytes per chunk 
   $buffer = ''; 
   $cnt =0; 
   // $handle = fopen($filename, 'rb'); 
   $handle = fopen($filename, 'rb'); 
   if ($handle === false)
   { 
       return false; 
   } 
   while (!feof($handle))
   { 
       $buffer = fread($handle, $chunksize); 
       echo $buffer; 
       ob_flush(); 
       flush(); 
       if ($retbytes)
       { 
           $cnt += strlen($buffer); 
       } 
   } 
   $status = fclose($handle); 
   if ($retbytes && $status)
   { 
       return $cnt; // return num. bytes delivered like readfile() does. 
   } 
   return $status; 
} 

?>