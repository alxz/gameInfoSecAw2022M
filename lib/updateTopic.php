<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to update a record in the table:
// Define variables and initialize with empty values
$topicid =  $titleENG = $titleFRA = $active = "";
$param_topicid = $param_titleENG = $param_titleFRA = $param_active = "";
$titleENG_err = $titleFRA_err = $active_err = "";
$ansTxt = [];
$ansTxtFRA = [];
$ansValid = [];
$ansId = [];

//$answer1FRAValid = true; $answer2FRAValid = $answer3FRAValid = $answer4FRAValid = false;
//$answer1ENGValid = true; $answer2ENGValid = $answer3ENGValid = $answer4ENGValid = false;

$tabName = "topicslist"; // set the name of the table where we have all topics stored
$id = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    // console_log("Current POST: ", $id);
    // console_log($_POST);
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
        // console_log("Parameters not empty:\n " 
        //     . $input_qTxt . " " 
        //     . $input_questionurl . " "
        //     . $input_qTxtFRA . " "
        //     . $input_questionurlFRA . " "
        //     . $topicid ) ;        
        // Prepare an insert statement
        $sql = "UPDATE tabquestions SET qTxt=?, questionurl=?, qTxtFRA=?, questionurlFRA=?, topicid=? WHERE qId=?";
        //$sql = "INSERT INTO tabquestions (qTxt, questionurl, qTxtFRA, questionurlFRA, topicid) VALUES (?, ?, ?, ?, ?)";
        // console_log("sql: " . $sql) ;

        if($stmt = mysqli_prepare($connection, $sql)){
            
            // console_log("Function mysqli_prepare successfully executed!");
            // console_log($stmt);
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssii", 
                        $param_qTxt, $param_questionurl, $param_qTxtFRA, $param_questionurlFRA, $param_topicid, $param_id);
            // Set parameters
            $param_qTxt = $qTxt;
            $param_questionurl = $questionurl;
            $param_qTxtFRA = $qTxtFRA;
            $param_questionurlFRA = $questionurlFRA;
            $param_topicid = $topicid;
            $param_id = $id;
            $errStr = htmlspecialchars($stmt->error);
            // console_log("param_qTxt, param_questionurl, param_qTxtFRA, param_questionurlFRA, param_topicid, param_id: "
            //             .$param_qTxt." / ".$param_questionurl." / "
            //             .$param_qTxtFRA." / ".$param_questionurlFRA." / "
            //             .$param_topicid." / ".$param_id)$allVars = get_defined_vars();
            
            // Attempt to execute the prepared statement
            $rc = mysqli_stmt_execute($stmt);
            if( $rc === true ){
                console_log("Record has been successfuly inserted!") ;      
                // header("location: landingQTable.php");
                // exit();
            } else{
                echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />";
                //console_log("Error: ".  mysqli_error($rc));
                // $allVars = get_defined_vars();
                // print_r($allVars);
                // debug_zval_dump($allVars); //debug_print_backtrace();
                console_log("Error inserting/updating dataTables:\n". htmlspecialchars($stmt->error));
                if ( false===$rc ) {
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }         
        
        // debug_zval_dump($allVars);
        
        console_log("===> Update answers ====");
        $sqlAns = [];
        $validAns = "";
        $stmtStr = [];
        $ansTxtFRA[0] = $_POST['answer1FRA'];
        $ansTxtFRA[1] = $_POST['answer2FRA']; 
        $ansTxtFRA[2] = $_POST['answer3FRA']; 
        $ansTxtFRA[3] = $_POST['answer4FRA'];
        $ansTxt[0] = $_POST['answer1ENG'];
        $ansTxt[1] = $_POST['answer2ENG']; 
        $ansTxt[2] = $_POST['answer3ENG'];
        $ansTxt[3] = $_POST['answer4ENG'];

        $ansId[0] = $_POST['answer1_id'];
        $ansId[1] = $_POST['answer2_id']; 
        $ansId[2] = $_POST['answer3_id'];
        $ansId[3] = $_POST['answer4_id'];

        if (isset($_POST['validAnsFRA'])) {
            $validAns = $_POST['validAnsFRA'];
            console_log("validAns = ". $validAns);
        }
        for ($i=0; $i < 4; $i++) { 
            //$ansTxt[$i] = "";
            //$ansTxtFRA[$i] = "";
            //$ansValid[$i] = 0;
            //$ansId[$i] = $i;
            console_log("ansTxt = $ansTxt[$i]");
            console_log("ansTxtFRA = $ansTxtFRA[$i]");
            console_log("ansId = $ansId[$i]");
        }
        // $ansValid[0] = $_POST['validAnsFRA'];
        // $ansValid[1] = $_POST['answer2FRAValid'];
        // $ansValid[2] = $_POST['answer3FRAValid'];
        // $ansValid[3] = $_POST['answer4FRAValid'];

        for ($i=0; $i < 4; $i++) { 
            $sqlAns = "UPDATE tabanswers SET ansTxt=?, ansTxtFRA=?, ansIsValid=? WHERE ansId=?";
            console_log("Prepare Statement ".$sqlAns) ;
            if($stmtStr[$i] = mysqli_prepare($connection, $sqlAns)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmtStr[$i], "ssii", 
                            $param_ansTxt, $param_ansTxtFRA, $param_ansIsValid, $param_ansId);
                // Set parameters
                $param_ansTxt = $ansTxt[$i];
                $param_ansTxtFRA = $ansTxtFRA[$i];
                if ($ansId[$i] == $validAns) {
                    $param_ansIsValid = 1;
                } else {
                    $param_ansIsValid = 0;
                }                            
                $param_ansId = $ansId[$i];

                console_log("Params: $param_ansTxt, $param_ansTxtFRA, $param_ansIsValid, $param_ansId");
                $errStr = htmlspecialchars($stmtStr[$i]->error);            
                // Attempt to execute the prepared statement
                $rc = mysqli_stmt_execute($stmtStr[$i]);
                if( $rc === true ){
                    console_log("Record has been successfuly inserted! ".$ansId[$i]) ;              
                    header("location: landingQTable.php");
                    exit();
                } else{
                    echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />";
                    //console_log("Error: ".  mysqli_error($rc));
                    // $allVars = get_defined_vars();
                    // print_r($allVars);
                    debug_zval_dump($allVars); //debug_print_backtrace();
                    console_log("Error inserting/updating dataTables:\n". htmlspecialchars($stmtStr[$i]->error));
                    if ( false===$rc ) {
                        die('execute() failed: ' . htmlspecialchars($stmt->error));
                    }
                }
                // Close statement
                mysqli_stmt_close($stmtStr[$i]);
            }
        }

    }    
    // Close connection
    mysqli_close($connection);
} else {
    // Check existence of id parameter before processing further
    // $topicid =  $titleENG = $titleFRA = $active = "";
    // $param_topicid = $param_titleENG = $param_titleFRA = $param_active = "";
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter        
        $id =  trim($_GET["id"]);
        // console_log("Using GET: \n");
        // console_log($_GET);
        $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
            //test if connection failed
            if(mysqli_connect_errno()){
                die("connection failed: "
                    . mysqli_connect_error()
                    . " (" . mysqli_connect_errno()
                    . ")");
        }   
        // Prepare a select statement
        $sql = "SELECT * FROM ".$tabName." WHERE topicid = ?";         
        console_log($sql);
        
        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);                        
            // Set parameters
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);            
                if(mysqli_num_rows($result) == 1){            
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);                    
                    // Retrieve individual field value
                    $topicid = $row["topicid"];
                    $titleENG = $row["titleENG"];
                    $titleFRA = $row["titleFRA"];
                    $active = $row["active"];                    
                } else{
                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    // URL doesn't contain valid id. Redirect to error page
                    // header("location: error.php");                    
                    exit();
                }
            } else{
                echo "<hr /> &nbsp; &nbsp; Oops! Something went wrong. Please try again later.<hr />";
            }  
            // Close statement
            mysqli_stmt_close($stmt);           
        }
    }
    
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
                    
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post"> 
                        <h2 class="mt-5">Update Question Record
                        <label> Id: <?php echo $id; ?></label></h2>
                                <input name="id" value="<?php echo $id; ?>" type="hidden">
                        <p>Please fill this form and submit to update TOPICs record in the database.</p>
                        <div class="form-group">
                            <label>Topics Tile (ENG)</label>
                            <textarea name="titleENG" 
                            class="form-control <?php echo (!empty($titleENG_err)) ? 'is-invalid' : ''; ?>"><?php echo $titleENG; ?></textarea>
                            <span class="invalid-feedback"><?php echo $titleENG_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Topics Title (FRA)</label>
                            <textarea name="titleFRA" 
                            class="form-control <?php echo (!empty($titleFRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $titleFRA; ?></textarea>
                            <span class="invalid-feedback"><?php echo $titleFRA_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Topic is Active: <?php echo $active; ?></label>  
                            <select id="active" name="active" class="form-control <?php echo (!empty($active_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $active; ?>">
                                <option value=1>Active</option>'
                                <option value=0>Deactivated</option>'
                            </select>                                                                     
                            <span class="invalid-feedback"><?php echo $active_err;?></span>
                        </div>
                        <hr />
                       
                        <hr />
                        <input type="submit" class="btn btn-primary" value="Submit">

                        <a href="landingTopicsTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <script type="text/JavaScript">
        document.getElementById("topicid").value='<?php echo $topicid ?>'
    </script> 
</body>
</html>