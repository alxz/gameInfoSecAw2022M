<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to Provide an access to the database reports and manage database tables data:

// Define variables and initialize with empty values
// $qTxt = $questionurl = $qTxtFRA = $questionurlFRA = $topicid = "";
// $input_qTxt = $input_questionurl = $input_qTxtFRA = $input_questionurlFRA = $input_topicid = "";
// $qTxt_err = $questionurl_err = $qTxtFRA_err = $questionurlFRA_err = $topicid_err = "";
$innerHTMLtblSrc = "";
$userid = "";
// Check existence of user account and password parameters before processing further
if(isset($_POST["userid"]) && !empty(trim($_POST["userid"])) 
    && isset($_POST["passwd"]) && !empty(trim($_POST["passwd"]))){
    // Prepare a select statement
    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
    $sql = "SELECT * FROM adminusers WHERE userid=? AND passwordHash=? ORDER BY 2 DESC;";
    $all_property = array();
    if($stmt = mysqli_prepare($connection, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_userid, $param_passwd);        
        // Set parameters
        $param_userid = trim($_POST["userid"]);
        $userid = $param_userid;
        // $param_passwd = base64_encode ( trim($_POST["passwd"]) ); // we encode to Base64 as this is the hash we store in the table
        $param_passwd = md5 ( trim($_POST["passwd"]) ); // we encode to MD5 as this is the hash we store in the table
        $passwd = $param_passwd;
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
        
            if(mysqli_num_rows($result) > 0){                                                                                  
                // $innerHTMLtblSrc .= '<table class="table table-bordered table-striped">';
                //     while ($property = mysqli_fetch_field($result)) {                            
                //         // echo '<th>' . $property->name . '</th>';  //get field name for header    
                //         array_push($all_property, $property->name);  //save those to array
                //     }                    
                // $innerHTMLtblSrc .= '<tbody>';
                // while ($row = mysqli_fetch_array($result)) {                        
                //     foreach ($all_property as $item) {
                //         $innerHTMLtblSrc .= "<tr>"; 
                //         $innerHTMLtblSrc .= '<th>' . $item . '</th>';  //get field name for header                                    
                //         $innerHTMLtblSrc .= '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
                //         $innerHTMLtblSrc .= '</tr>';                                                                  
                //     }                        
                // }
                // $innerHTMLtblSrc .= '</tbody></table><br><hr />';

                // Free result set
                mysqli_free_result($result);
                session_start();
                if (!isset($_SESSION['time'])) {
                    $_SESSION['time'] = date("H:i:s");
                }
                $_SESSION['adminSessionId'] = uuid();
                $sessionID = $_SESSION['adminSessionId']; // sessionid
                try {
                    //code...
                    // Create connection
		            $conn = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
		            // Check connection
		            if (!$conn) {
		                die("Connection failed: " . mysqli_connect_error());
		            }

                    $sql = "Update adminusers SET sessionid=? WHERE userid=?";
                    if($stmt = mysqli_prepare($connection, $sql)){ 
                        mysqli_stmt_bind_param($stmt, "ss", $param_sessionID, $param_userid);
                        $param_sessionID = $sessionID;
                        $param_userid = $userid;
                        $rc = mysqli_stmt_execute($stmt);
                        if( $rc === true ){ 
                            console_log("sessionId created!");
                        }else{
                            echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />";
                            //console_log("Error: ".  mysqli_error($rc));
                            // $allVars = get_defined_vars();
                            // print_r($allVars);
                            // debug_zval_dump($allVars); //debug_print_backtrace();
                            console_log("Error inserting/updating dataTables:\n". htmlspecialchars($stmt->error));
                            // if ( false===$rc ) {
                            //     die('execute() failed: ' . htmlspecialchars($stmt->error));
                            // }
                        }                        
                    }

                } catch (\Throwable $th) {
                    //throw $th;
                    console_log("Error: ".$th);
                }
                // Close statement
                mysqli_stmt_close($stmt);
                $innerHTMLtblSrc = '<hr />'. 
                '<p><a href="/gameInfoSecAw2022M/lib/landingQTable.php" target="_blank" class="btn btn-primary">Questions Dashboard: View Questions List</a> (landingQTable: ver 05/2022)</p>' .
                '<p><a href="/gameInfoSecAw2022M/lib/createQTable.php" target="_blank" class="btn btn-primary">Create New Question </a> (gameInfoSecAw2022M/createQTable: ver 05/2022)</p>' .                
                '<p><a href="/gameInfoSecAw2022M/lib/landingUsrTable.php" target="_blank" class="btn btn-primary">Users Dashboard</a> (gameInfoSecAw2022M/landingUsrTable: ver 05/2022)</p>' .	
                '<p><a href="/gameInfoSecAw2022M/lib/landingTopicsTable.php" target="_blank" class="btn btn-primary">Topics Dashboard</a> (gameInfoSecAw2022M/landingTopicsTable: ver 05/2022)</p>' .
                '<hr />' .
                '<p><a href="/gameInfoSecAw2022M/rest/editData.php" target="_blank" class="btn btn-primary">->>> View Data (old style)</a> (gameInfoSecAw2022M/editData: ver 05/2022)</p>' .
                '<hr />';
            } else{
                echo '<div class="alert alert-danger"><br><br><em>No records were found.</em></div>';
            }
        } else{
            echo "<hr /> &nbsp; &nbsp; Oops! Something went wrong. Please try again later.<hr />";
        }        
        // Attempt to execute the prepared statement
        // if(mysqli_stmt_execute($stmt)){
        //     $result = mysqli_stmt_get_result($stmt);    
        //     if(mysqli_num_rows($result) == 1){
        //         /* Fetch result row as an associative array. Since the result set
        //         contains only one row, we don't need to use while loop */
        //         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
        //         // Retrieve individual field value
        //         $qTxt = $row["qTxt"];
        //         $questionurl = $row["questionurl"];
        //         $qTxtFRA = $row["qTxtFRA"];
        //         $questionurlFRA = $row["questionurlFRA"];
        //     } else{
        //         // URL doesn't contain valid id parameter. Redirect to error page
        //         header("location: error.php");
        //         exit();
        //     }            
        // } else{
        //     echo "Oops! Something went wrong. Please try again later.";
        // }
    }    
    // Close connection
    mysqli_close($connection);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    // header("location: error.php");
    // header("location: landingQTable.php");
    // exit();

    $innerHTMLtblSrc = `
    <div class="data-input-form-field-div">
    user: &nbsp;<input type="text" id="tabsFromDB" value="tabusers" name="tabsFromDB" />
    <br />                                
    password:&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" id="saveToCSV" name="saveToCSV" value="./export.csv">                                
    </div>
    <div class="data-input-form-field-div">
        <button type="submit" formmethod="post">Login</button>                                
    </div> `;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin access to the database / manage data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            /* width: 600px; */
            width: 90%;
            /* margin: 0 auto; */
            margin-left: auto;
            margin-right: auto;
            max-width: 960px; /* 2 */
            padding-right: 10px; /* 3 */
            padding-left:  10px; /* 3 */
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>    
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Admin access to the database / manage data<?php echo $userid; ?></h1> 
                    <div class="form-group">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php if ( trim($innerHTMLtblSrc) == "" ) { ?>
                            <div id="loginDiv">
                                <div class="pull-right">                                
                                    <div class="data-input-form-field-div justify-content-center">
                                        <p>
                                        user: &nbsp;<input type="text" id="userid" value="" name="userid" />
                                        &nbsp;&nbsp;&nbsp;&nbsp;                                
                                        password:&nbsp;&nbsp;
                                        <input type="password" id="passwd" name="passwd" value="">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" formmethod="post">Login</button>
                                        </p>                                
                                    </div>                  
                                </div>
                            </div>
                        <?php } else { ?>    
                            <label>Adminitrative actions (user: <?php echo $userid?> )</label>
                            <p><b><?php echo $innerHTMLtblSrc; ?></b></p>
                        <?php } ?>
                        <br> <hr />
                        </form>
                    </div>
                    
                    <p><a href="adminMenu.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
    <script type="text/javascript">
        const divLogin = document.getElementById("loginDiv");
        //divLogin.innerHTML = " " + <?php echo $innerHTMLtblSrc; ?> + " " ;
    </script>
</body>
</html>