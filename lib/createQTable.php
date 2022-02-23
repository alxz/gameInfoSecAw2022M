<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to creaste a record in the table:
// Define variables and initialize with empty values
$qTxt = $questionurl = $qTxtFRA = $questionurlFRA = $topicid = "";
$input_qTxt = $input_questionurl = $input_qTxtFRA = $input_questionurlFRA = $input_topicid = "";
$qTxt_err = $questionurl_err = $qTxtFRA_err = $questionurlFRA_err = $topicid_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    console_log($_POST);
    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
        //test if connection failed
        if(mysqli_connect_errno()){
            die("connection failed: "
                . mysqli_connect_error()
                . " (" . mysqli_connect_errno()
                . ")");
    }
    // Validate question Text: qTxt
    $input_qTxt = trim($_POST["qTxt"]);
    if(empty($input_qTxt)){
        $qTxt_err = "Please enter a qTxt.";
    // } elseif(!filter_var($input_qTxt, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $qTxt_err = "Please enter a valid qTxt.";
    } else{
        $qTxt = $input_qTxt;
    }
    
    // Validate questionurl
    $input_questionurl = trim($_POST["questionurl"]);
    if(empty($input_questionurl)){
        $questionurl_err = "Please enter a questionurl.";     
    } else{
        $questionurl = $input_questionurl;
    }
    
    // Validate qTxtFRA
    $input_qTxtFRA = trim($_POST["qTxtFRA"]);
    if(empty($input_qTxtFRA)){
        $qTxtFRA_err = "Please enter the qTxtFRA";     
    // } elseif(!ctype_digit($input_salary)){
    //     $salary_err = "Please enter a positive integer value.";
    } else{
        $qTxtFRA = $input_qTxtFRA;
    }

    // Validate questionurlFRA
    $input_questionurlFRA = trim($_POST["questionurlFRA"]);
    if(empty($input_questionurlFRA)){
        $questionurlFRA_err = "Please enter a questionurlFRA.";     
    } else{
        $questionurlFRA = $input_questionurlFRA;
    }
    // Validate topicid
    $input_topicid = trim($_POST["topicid"]);
    if(empty($input_topicid)){
        $topicid_err = "Please enter the topicid";     
    } elseif(!ctype_digit($input_topicid)){
        $topicid_err = "Please enter a positive integer value.";
        $topicid = "";
    } else{
        $topicid = $input_topicid;
    }
    
    // Check input errors before inserting in database
    if(!empty($input_qTxt) && !empty($input_questionurl) 
        && !empty($input_qTxtFRA) && !empty($input_questionurlFRA)
        &&  !empty($topicid)){
        console_log("Parameters not empty:\n " 
            . $input_qTxt . " " 
            . $input_questionurl . " "
            . $input_qTxtFRA . " "
            . $input_questionurlFRA . " "
            . $topicid ) ;        
        // Prepare an insert statement
        $sql = "INSERT INTO tabquestions (qTxt, questionurl, qTxtFRA, questionurlFRA, topicid) VALUES (?, ?, ?, ?, ?)";
        console_log("sql: " . $sql) ;
        if($stmt = mysqli_prepare($connection, $sql)){
            console_log("Function mysqli_prepare successfully executed!");
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", 
                        $param_qTxt, $param_questionurl, $param_qTxtFRA, $param_questionurlFRA, $topicid);
            // Set parameters
            $param_qTxt = $qTxt;
            $param_questionurl = $questionurl;
            $param_qTxtFRA = $qTxtFRA;
            $param_questionurlFRA = $questionurlFRA;
            
            // Attempt to execute the prepared statement
            $rc = mysqli_stmt_execute($stmt);
            if( $rc === true ){
                console_log("Record has been successfuly inserted!") ;
                // Records created successfully. Redirect to landing page
                // echo `
                // <script type="text/JavaScript">
                //     document.getElementById("messageDiv").style.display = "block";
                //     document.getElementById("createRcFields").style.display = "none";
                // </script>`;               
                header("location: landingQTable.php");
                exit();
            } else{
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
            // Close statement
            mysqli_stmt_close($stmt);
        }         
        
    }    
    // Close connection
    mysqli_close($connection);
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
                <div class="col-md-12" id="createRcFields">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add new question record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Question Text (ENG)</label>
                            <textarea name="qTxt" 
                            class="form-control <?php echo (!empty($qTxt_err)) ? 'is-invalid' : ''; ?>"><?php echo $qTxt; ?></textarea>
                            <span class="invalid-feedback"><?php echo $qTxt_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Question Video URL (ENG)</label>
                            <input type="text" name="questionurl" 
                            class="form-control <?php echo (!empty($questionurl_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $questionurl; ?>">
                            <span class="invalid-feedback"><?php echo $questionurl_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Question Text (FRA)</label>
                            <textarea name="qTxtFRA" 
                            class="form-control <?php echo (!empty($qTxtFRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $qTxtFRA; ?></textarea>
                            <span class="invalid-feedback"><?php echo $qTxtFRA_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Question Video URL (FRA)</label>
                            <input type="text" name="questionurlFRA" 
                            class="form-control <?php echo (!empty($questionurlFRA_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $questionurlFRA; ?>">
                            <span class="invalid-feedback"><?php echo $questionurlFRA_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Question Topic</label>                        
                            <select id="topicid" name="topicid" class="form-control <?php echo (!empty($topicid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $topicid; ?>">
                                <option value="1">UNDEFINED/COMMON TOPIC</option>
                                <option value="2">COMPLEX PASSWORDS</option>
                                <option value="3">INFORMATION CLASSIFICATION</option>
                                <option value="4">CONFIDENTIAL INFORMATION UNPROTECTED</option>
                                <option value="5">SAFE ONLINE SHOPPING</option>
                                <option value="6">TELEWORK AND INFORMATION SECURITY</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $topicid_err;?></span>
                        </div>


                        <input type="submit" class="btn btn-primary" value="Submit">

                        <a href="landingQTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
                <div class="col-md-12" id="messageDiv">
                    <div id="message">
                        <a href="createQuestion.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Add Another Record</a>
                        &nbsp; &nbsp; &nbsp;
                        <a href="landingQTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>