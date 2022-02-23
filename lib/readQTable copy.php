<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');

// A script to creaste a record in the table:
// Define variables and initialize with empty values
$qTxt = $questionurl = $qTxtFRA = $questionurlFRA = $topicid = "";
$input_qTxt = $input_questionurl = $input_qTxtFRA = $input_questionurlFRA = $input_topicid = "";
$qTxt_err = $questionurl_err = $qTxtFRA_err = $questionurlFRA_err = $topicid_err = "";
console_log("Starting: readQTable.php");
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Prepare a select statement
    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
    $sql = "SELECT tbl1.*, tbl2.titleENG FROM tabquestions as tbl1, topicslist as tbl2 WHERE tbl1.qId = ? AND tbl1.topicid = tbl2.topicid;";
    // $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($connection, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $qTxt = $row["qTxt"];
                $questionurl = $row["questionurl"];
                $qTxtFRA = $row["qTxtFRA"];
                $questionurlFRA = $row["questionurlFRA"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($connection);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    // header("location: error.php");
    header("location: landingQTable.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        #messageDiv {
            width: 80%;
            min-width: 200px;
            display: none; 
            float: none;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>qTxt</label>
                        <p><b><?php echo $row["qTxt"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>questionurl</label>
                        <p><b><?php echo $row["questionurl"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>qTxt</label>
                        <p><b><?php echo $row["qTxtFRA"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>questionurlFRA</label>
                        <p><b><?php echo $row["questionurlFRA"]; ?></b></p>
                    </div>
                    <p><a href="landingQTable.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>