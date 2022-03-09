<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to create a record in the table:
// Define variables and initialize with empty values
$tableName = "tabanswers";
$refTabName = "tabquestions"; 
$ansId = $ansTxt = $ansTxtFRA = $ansIsValid = $ansQId = "";
$param_ansQId = $param_titleENG = $param_titleFRA = $param_ansIsValid = "";
$ansTxt_err = $ansTxtFRA_err = $ansIsValid_err = $ansQId_err = "";
$questionsList = [];
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //console_log($_POST);
    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
        //test if connection failed
        if(mysqli_connect_errno()){
            die("connection failed: "
                . mysqli_connect_error()
                . " (" . mysqli_connect_errno()
                . ")");
    }
    
    // Validate question Text: qTxt
    $input_ansTxt = trim($_POST["ansTxt"]);
    if(empty($input_ansTxt)){
        $ansTxt_err = "Please enter an answer text in English.";
    // } elseif(!filter_var($input_qTxt, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $qTxt_err = "Please enter a valid qTxt.";
    } else{
        $ansTxt = $input_ansTxt;
    }

    $input_ansTxtFRA = trim($_POST["ansTxtFRA"]);
    if(empty($input_ansTxtFRA)){
        $ansTxtFRA_err = "Please enter an answer text in French.";
    } else{
        $ansTxtFRA = $input_ansTxtFRA;
    }   
    //param_active  
    $ansIsValid = trim($_POST["ansIsValid"]);
    $ansQId = trim($_POST["ansQId"]);
    // $ansId = trim($_POST["id"]);

    // Check input errors before inserting in database  
    if(!empty($ansTxt) && !empty($ansTxtFRA)){            
        // Prepare an insert statement: $sql = "SELECT * FROM ".$tableName." WHERE ansId=? AND ansQId=?";
        // $sql = "INSERT INTO topicslist (titleENG, titleFRA, active) VALUES (?, ?, ?)";
        // $sql = "UPDATE ".$tableName." SET ansTxt=?, ansTxtFRA=?, ansQId=?, ansIsValid=? WHERE ansId=?";
        $sql = "INSERT INTO ".$tableName." (ansTxt, ansTxtFRA, ansQId, ansIsValid) VALUES (?, ?, ?, ?)";
        console_log("sql: " . $sql) ;

        if($stmt = mysqli_prepare($connection, $sql)){
            //$ansId = $ansTxt = $ansTxtFRA = $ansIsValid = $ansQId = "";
            //$param_ansQId = $param_titleENG = $param_titleFRA = $param_active = "";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssii", 
                        $param_ansTxt, $param_ansTxtFRA, $param_ansQId, $param_ansIsValid);
            // Set parameters:  
            // $param_ansId = $ansId; // id
            $param_ansTxt = $ansTxt;
            $param_ansTxtFRA = $ansTxtFRA;
            $param_ansIsValid = $ansIsValid;
            $param_ansQId = $ansQId;
            $errStr = htmlspecialchars($stmt->error);
            // Attempt to execute the prepared statement
            console_log("ansTxt= ".$ansTxt."; ansTxtFRA= ".$ansTxtFRA.";  ansQId= ".$ansQId."; ansIsValid= ".$ansIsValid);
            $rc = mysqli_stmt_execute($stmt);
            if( $rc === true ){
                console_log("Record has been successfuly inserted!") ;      
                // header("location: landingAnswersTable.php");
                // exit();
            } else{
                echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />";
                // console_log("Error: ".  mysqli_error($rc));
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
    }    
    // Close connection
    mysqli_close($connection);

} elseif($_SERVER["REQUEST_METHOD"] == "GET") {
    console_log($_GET);
    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
        //test if connection failed
        if(mysqli_connect_errno()){
            die("connection failed: "
                . mysqli_connect_error()
                . " (" . mysqli_connect_errno()
                . ")");
        }
        // Include config file                    
        // Attempt select query execution
        $all_property = array();  //declare an array for saving property
        // $tableName = "tabanswers";
        // $refTabName = "tabquestions"; 
        $sql = "SELECT * FROM tabanswers WHERE ansQId=? AND ansId=?;";
        // console_log("ConsoleLOG:  " . $sql); //$result = mysqli_query($connection,$sql); // $result = mysqli_query($link, $sql)
        
        
        $all_property = array(); // to reset the array
        $questionsList = []; // to clear the array
        $sqlQestions = "SELECT * FROM tabquestions ORDER BY qId DESC;";
        if ( $result = mysqli_query($connection,$sqlQestions) ){
            if(mysqli_num_rows($result) > 0){   
                    while ($property = mysqli_fetch_field($result)) {                                                                      
                            array_push($all_property, $property->name);  //save those to array
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $arrStr = "";
                        $arrKey = "";
                        foreach ($all_property as $item) {
                          if (strtolower($item) == "qid") {
                            $arrKey = $row[$item];
                            $arrStr .= " " .$row[$item];
                          }  
                          if (strtolower($item) == "qtxt") {
                              //(strtolower($item) == "qtxt" || strtolower($item) == "qtxtfra")
                            $arrStr .= " | " .$row[$item];
                          }                                                                                                     
                        }
                        $questionsList[$arrKey] = substr($arrStr,0,120); 
                    }
                    // console_log("sqlQestions: ".$sqlQestions);
                    // console_log("Array questionsList: ".implode($questionsList));
                // Free result set
                mysqli_free_result($result);
            } else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
        } else{
            echo "<hr />Oops! Something went wrong. Please try again later.<hr />";
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
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post"> 
                        <h2 class="mt-5">Create New Answer Records</h2>                                
                        <p>Please fill this form and submit to insert answers record in the database.</p>
                        <div class="form-group">
                            <label>Answer Text (ENG)</label>
                            <textarea name="ansTxt" 
                            class="form-control <?php echo (!empty($ansTxt_err)) ? 'is-invalid' : ''; ?>"><?php echo $ansTxt; ?></textarea>
                            <span class="invalid-feedback"><?php echo $ansTxt_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Answer Text (FRA)</label>
                            <textarea name="ansTxtFRA" 
                            class="form-control <?php echo (!empty($ansTxtFRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $ansTxtFRA; ?></textarea>
                            <span class="invalid-feedback"><?php echo $ansTxtFRA_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Answer is Valid? <?php echo $ansIsValid; ?></label>  
                            <select id="ansIsValid" name="ansIsValid" class="form-control <?php echo (!empty($ansIsValid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ansIsValid; ?>">
                                <option value="0">inValid</option>'    
                                <option value="1">Valid</option>'                                
                            </select>                                                                     
                            <span class="invalid-feedback"><?php echo $ansIsValid_err;?></span>
                        </div>    
                        
                        <div class="form-group">
                            <label>Question Related: <?php echo $ansQId; ?></label>  
                            <select id="ansQId" name="ansQId" class="form-control <?php echo (!empty($ansQId_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ansQId; ?>">
                                <?php foreach ($questionsList as $key => $value) { 
                                    # read all topics from associative arrrat - list all topics
                                    echo ' <option value="'.$key.'">'.$value.'</option>';
                                } ?>
                            </select>                                                                     
                            <span class="invalid-feedback"><?php echo $ansQId_err;?></span>
                        </div>

                        <hr />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="landingAnswersTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>                    
                </div>

                <div class="col-md-12" id="messageDiv">
                    <div id="message">
                        <a href="createAnsTable.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Add Another Record</a>
                        &nbsp; &nbsp; &nbsp;
                        <a href="landingAnswersTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>