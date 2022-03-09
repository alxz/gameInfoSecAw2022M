<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to update a record in the table:
// Define variables and initialize with empty values
$tableName = "tabanswers";
$refTabName = "tabquestions"; 
$ansId = $ansTxt = $ansTxtFRA = $ansIsValid = $ansQId = "";
$param_ansQId = $param_titleENG = $param_titleFRA = $param_ansIsValid = "";
$ansTxt_err = $ansTxtFRA_err = $ansIsValid_err = $ansQId_err = "";
// $ansTxt = [];
// $ansTxtFRA = [];
// $ansIsValid = [];
// $ansId = [];

//$answer1FRAValid = true; $answer2FRAValid = $answer3FRAValid = $answer4FRAValid = false;
//$answer1ENGValid = true; $answer2ENGValid = $answer3ENGValid = $answer4ENGValid = false;

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
    $ansId = trim($_POST["id"]);
    
    // Check input errors before inserting in database  
    if(!empty($ansTxt) && !empty($ansTxtFRA)){            
        // Prepare an insert statement: $sql = "SELECT * FROM ".$tableName." WHERE ansId=? AND ansQId=?";
        $sql = "UPDATE ".$tableName." SET ansTxt=?, ansTxtFRA=?, ansQId=?, ansIsValid=? WHERE ansId=?";
        console_log("sql: " . $sql) ;

        if($stmt = mysqli_prepare($connection, $sql)){
            //$ansId = $ansTxt = $ansTxtFRA = $ansIsValid = $ansQId = "";
            //$param_ansQId = $param_titleENG = $param_titleFRA = $param_active = "";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiii", 
                        $param_ansTxt, $param_ansTxtFRA, $param_ansQId, $param_ansIsValid, $param_ansId);
            // Set parameters:  
            $param_ansId = $ansId; // id
            $param_ansTxt = $ansTxt;
            $param_ansTxtFRA = $ansTxtFRA;
            $param_ansIsValid = $ansIsValid;
            $param_ansQId = $ansQId;
            $errStr = htmlspecialchars($stmt->error);
            // Attempt to execute the prepared statement
            console_log("ansId = ".$ansId."; ansTxt= ".$ansTxt."; ansTxtFRA= ".$ansTxtFRA.";  ansQId= ".$ansQId."; ansIsValid= ".$ansIsValid);
            $rc = mysqli_stmt_execute($stmt);
            if( $rc === true ){
                console_log("Record has been successfuly inserted!") ;      
                header("location: landingAnswersTable.php");
                exit();
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
} else {
    // Check existence of id parameter before processing further
    // $topicid =  $titleENG = $titleFRA = $active = "";
    // $param_topicid = $param_titleENG = $param_titleFRA = $param_active = "";
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))
        && isset($_GET["qid"]) && !empty(trim($_GET["qid"]))){
        // Get URL parameter        
        $id =  trim($_GET["id"]);
        $ansQId = trim($_GET["qid"]); 
        $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
            //test if connection failed
            if(mysqli_connect_errno()){
                die("connection failed: "
                    . mysqli_connect_error()
                    . " (" . mysqli_connect_errno()
                    . ")");
        }   
        // Prepare a select statement
        $sql = "SELECT * FROM ".$tableName." WHERE ansId=? AND ansQId=?";         
        console_log($sql);
        
        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_id, $param_ansQId);                        
            // Set parameters
            $param_id = $id;
            $param_ansQId = $ansQId;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);            
                if(mysqli_num_rows($result) == 1){            
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);                    
                    // Retrieve individual field value
                    $ansId = $row["ansId"];
                    $ansTxt = $row["ansTxt"];
                    $ansTxtFRA = $row["ansTxtFRA"];
                    $ansIsValid = $row["ansIsValid"];                    
                } else{
                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: landingAnswersTable.php");                    
                    exit();
                }
                //console_log("ansId = ".$ansId."; ansTxt= ".$ansTxt."; ansTxtFRA= ".$ansTxtFRA."; active= ".$ansIsValid);
            } else{
                echo "<hr /> &nbsp; &nbsp; Oops! Something went wrong. Please try again later.<hr />";
            }  
            // Close statement
            mysqli_stmt_close($stmt);           
        }

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
                    console_log("sqlQestions: ".$sqlQestions);
                    console_log("Array questionsList: ".implode($questionsList));
                // Free result set
                mysqli_free_result($result);
            } else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
        } else{
            echo "<hr />Oops! Something went wrong. Please try again later.<hr />";
        }

    }    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Answer Record</title>
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
                        <h2 class="mt-5">Update Answers Records
                        <label> Id: <?php echo $id; ?></label></h2>
                                <input name="id" id="id" value="<?php echo $id; ?>" type="hidden">
                        <p>Please fill this form and submit to update answers record in the database.</p>
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
            </div>        
        </div>
    </div>
    <script type="text/JavaScript">
        document.getElementById("ansIsValid").value='<?php echo $ansIsValid ?>'
    </script> 
</body>
</html>