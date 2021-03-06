<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to update a record in the table:
// Define variables and initialize with empty values
$qTxt = $questionurl = $qTxtFRA = $questionurlFRA = $topicid = "";
$input_qTxt = $input_questionurl = $input_qTxtFRA = $input_questionurlFRA = $input_topicid = "";
$qTxt_err = $questionurl_err = $qTxtFRA_err = $questionurlFRA_err = $topicid_err = "";
$param_ansTxt = $param_ansIsValid = $param_ansTxtFRA = $param_ansId = "";
$answer1FRA = $answer2FRA = $answer3FRA = $answer4FRA = "";
$answer1ENG = $answer2ENG = $answer3ENG = $answer4ENG = "";
$answer1Valid = $answer2Valid = $answer3Valid = $answer4Valid = "";
$answer1ENG_err = $answer2ENG_err = $answer3ENG_err = $answer4ENG_err = "";
$answer1FRA_err = $answer2FRA_err = $answer3FRA_err = $answer4FRA_err = "";
$ansQId = "";
$sqlAns1 = $sqlAns2 = $sqlAns3 =$sqlAns4 = "";
$ansTxt = [];
$ansTxtFRA = [];
$ansValid = []; $ansValid[0] = 0; $ansValid[1] = 0; $ansValid[2] = 0; $ansValid[3] = 0;
$ansId = [];

//$answer1FRAValid = true; $answer2FRAValid = $answer3FRAValid = $answer4FRAValid = false;
//$answer1ENGValid = true; $answer2ENGValid = $answer3ENGValid = $answer4ENGValid = false;

$tabName = "tabquestions"; // set the name of the table where we have all questions stored
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


    // Validate answer1FRA
    $input_answer1FRA = trim($_POST["answer1FRA"]);
    if(empty($input_answer1FRA)){
        $answer1FRA_err = "Please enter a answer1FRA.";     
    } else{
        $answer1FRA = $input_answer1FRA;
    }

    // Validate answer1ENG
    $input_answer1ENG = trim($_POST["answer1ENG"]);
    if(empty($input_answer1ENG)){
        $answer1ENG_err = "Please enter a answer1ENG.";     
    } else{
        $answer1ENG = $input_answer1ENG;
    }    

    // Validate answer2FRA
    $input_answer2FRA = trim($_POST["answer2FRA"]);
    if(empty($input_answer2FRA)){
        $answer2FRA_err = "Please enter a answer2FRA.";     
    } else{
        $answer2FRA = $input_answer2FRA;
    }

    // Validate answer2ENG
    $input_answer2ENG = trim($_POST["answer2ENG"]);
    if(empty($input_answer2ENG)){
        $answer2ENG_err = "Please enter a answer2ENG.";     
    } else{
        $answer2ENG = $answer2ENG_err;
    }  
    
    
    // Validate answer3FRA
    $input_answer3FRA = trim($_POST["answer3FRA"]);
    if(empty($input_answer3FRA)){
        $answer3FRA_err = "Please enter a answer3FRA.";     
    } else{
        $answer3FRA = $input_answer3FRA;
    }

    // Validate answer3ENG
    $input_answer3ENG = trim($_POST["answer3ENG"]);
    if(empty($input_answer3ENG)){
        $answer3ENG_err = "Please enter a answer3ENG.";     
    } else{
        $answer3ENG = $input_answer3ENG;
    }    


    // Validate answer4FRA
    $input_answer4FRA = trim($_POST["answer4FRA"]);
    if(empty($input_answer4FRA)){
        $answer4FRA_err = "Please enter a answer4FRA.";     
    } else{
        $answer4FRA = $input_answer4FRA;
    }

    // Validate answer4ENG
    $input_answer4ENG = trim($_POST["answer4ENG"]);
    if(empty($input_answer4ENG)){
        $answer4ENG_err = "Please enter a answer4ENG.";     
    } else{
        $answer4ENG = $answer4ENG_err;
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
        $ansQId  = $param_id;
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

        $ansId[0] = $_POST['answer1FRA_id'];
        $ansId[1] = $_POST['answer2FRA_id']; 
        $ansId[2] = $_POST['answer3FRA_id'];
        $ansId[3] = $_POST['answer4FRA_id'];

        if (isset($_POST['validAnsFRA'])) {
            $validAns = $_POST['validAnsFRA'];  // Check option from validAnsFRA
            console_log("validAns = ". $validAns);
        }
        if (isset($_POST['validAnswer'])) {
            $validAns = $_POST['validAnswer'];
            console_log("validAnswer = ". $validAns);
        }
        for ($i=0; $i < 4; $i++) { 
            console_log("ansTxt = $ansTxt[$i]");
            console_log("ansTxtFRA = $ansTxtFRA[$i]");
            console_log("ansId = $ansId[$i]");
        }
        // $ansValid[0] = $_POST['validAnsFRA'];
        // $ansValid[1] = $_POST['answer2FRAValid'];
        // $ansValid[2] = $_POST['answer3FRAValid'];
        // $ansValid[3] = $_POST['answer4FRAValid'];

        for ($i=0; $i < 4; $i++) { 
            $sqlAns = "UPDATE tabanswers SET ansTxt=?, ansQId=?, ansTxtFRA=?, ansIsValid=? WHERE ansId=?";
            // console_log("Prepare Statement ".$sqlAns) ;
            if($stmtStr[$i] = mysqli_prepare($connection, $sqlAns)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmtStr[$i], "sisii", 
                            $param_ansTxt, $param_ansQId, $param_ansTxtFRA, $param_ansIsValid, $param_ansId);
                // Set parameters
                $param_ansQId = $ansQId;
                $param_ansTxt = $ansTxt[$i];
                $param_ansTxtFRA = $ansTxtFRA[$i];
                if ($ansId[$i] == $validAns) {
                    $param_ansIsValid = 1;
                    console_log("Checking param_ansIsValid[$i] = $param_ansIsValid");
                } else {
                    $param_ansIsValid = 0;
                }    
                console_log("Checking ansId[$i] = $ansId[$i]");                        
                $param_ansId = $ansId[$i];

                console_log("Current [$i] Params: param_ansTxt=$param_ansTxt, param_ansQId=$param_ansQId,"
                        ." param_ansTxtFRA=$param_ansTxtFRA, param_ansIsValid=$param_ansIsValid, param_ansId=$param_ansId");
                $errStr = htmlspecialchars($stmtStr[$i]->error);            
                // Attempt to execute the prepared statement
                $rc = mysqli_stmt_execute($stmtStr[$i]);
                // $allVars = [];
                // $strErrVars ="";
                if( $rc === true ){
                    // $allVars = get_defined_vars();
                    // $strErrVars = implode(" || ",$allVars);
                    //console_log("Record has been successfuly inserted! ".$ansId[$i]) ;
                    
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
        $sql = "SELECT * FROM ".$tabName." WHERE qId = ?";         
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
                    $qTxt = $row["qTxt"];
                    $questionurl = $row["questionurl"];
                    $qTxtFRA = $row["qTxtFRA"];
                    $questionurlFRA = $row["questionurlFRA"];    
                    $questionurlFRA = $row["questionurlFRA"];
                    $topicid = $row["topicid"];
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
        $all_property = array(); // to reset the array
        $topicsList = []; // to clear the array
        $sqlTopics = "SELECT * FROM topicslist ORDER BY topicid ASC;";
        if ( $result = mysqli_query($connection,$sqlTopics) ){
            if(mysqli_num_rows($result) > 0){   
                        while ($property = mysqli_fetch_field($result)) {                                                                      
                            array_push($all_property, $property->name);  //save those to array
                        }
                    while ($row = mysqli_fetch_array($result)) {
                        $arrStr = "";
                        $arrKey = "";
                        foreach ($all_property as $item) {
                          if (strtolower($item) == "topicid") {
                            $arrKey = $row[$item];
                            $arrStr .= " " .$row[$item];
                          }  
                          if (strtolower($item) == "titleeng" || strtolower($item) == "titlefra") {
                            $arrStr .= " | " .$row[$item];
                          }                                    
                          if ( strtolower($item) == "active" ) {
                              if ( $row[$item] == 0 || $row[$item] == "0") {
                                //echo "<td>" . "deactivated" . "</td>";
                                $arrStr .= " | deactivated";
                              } else {
                                //echo "<td>" . "active" . "</td>";
                                $arrStr .= " | active";
                              }                            
                          }                                       
                        }
                        $topicsList[$arrKey] = $arrStr;
                    }
                // Free result set
                mysqli_free_result($result);
            } else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
        } else{
            echo "<hr />Oops! Something went wrong. Please try again later.<hr />";
        }
        $sqlAns = "SELECT * FROM tabanswers WHERE ansQId=?;";    
        
        $allAns_property = [];
        if($stmtAns = mysqli_prepare($connection, $sqlAns)){ 
            mysqli_stmt_bind_param($stmtAns, "i", $param_ansQId);
            $param_ansQId = $id;
            if(mysqli_stmt_execute($stmtAns)){
                $resultAns = mysqli_stmt_get_result($stmtAns);
                if(mysqli_num_rows($resultAns) > 0){ 
                    while ($property = mysqli_fetch_field($resultAns)) {                            
                        // echo '<th>' . $property->name . '</th>';  //get field name for header    
                        array_push($allAns_property, $property->name);  //save those to array
                    }                    
                
                $qIndex = 0;
                while ($row = mysqli_fetch_array($resultAns)) {         
                    foreach ($allAns_property  as $item) {                                
                        if ( strtolower($item) == "ansid"  ) {
                            $ansId[$qIndex] = $row[$item];
                        } elseif ( strtolower($item) == "ansqid") {
                            //not shown
                        } elseif ( strtolower($item) == "ansisvalid") {    
                            if ($row[$item] == '1') {
                                $ansValid[$qIndex] = 1;
                            } else {
                                $ansValid[$qIndex] = 0;
                            }     
                            console_log("ansValid[".$qIndex."]= ".$ansValid[$qIndex]);
                            //$ansValid[$qIndex] = ($row[$item] == '1' ? true : false ); //get items using property value
                           
                        } elseif ( strtolower($item) == "anstxt") {
                            $ansTxt[$qIndex] = $row[$item];                                                              
                        } elseif ( strtolower($item) == "anstxtfra") {
                            $ansTxtFRA[$qIndex] = $row[$item];                                                              
                        }                                                                                              
                    }  
                    $qIndex++;                     
                }
                $answer1FRA = $ansTxtFRA[0];
                $answer2FRA = $ansTxtFRA[1]; 
                $answer3FRA = $ansTxtFRA[2]; 
                $answer4FRA = $ansTxtFRA[3];
                $answer1ENG = $ansTxt[0];
                $answer2ENG = $ansTxt[1]; 
                $answer3ENG = $ansTxt[2];
                $answer4ENG = $ansTxt[3];
                
                foreach ($ansId as $thisId) {
                    console_log("AnswerId = ".$thisId);
                }
                foreach ($ansValid as $thisId) {
                    $strVal = $thisId ? 'true' : 'false';
                    console_log("ansValid = ".$strVal);
                }
                // Free result set
                mysqli_free_result($resultAns);
                }
            }
        }
        for ($i=0; $i < 4; $i++) { 
            // $ansTxt[$i] = "";
            // $ansTxtFRA[$i] = "";
            // $ansValid[$i] = 0;
            // $ansId[$i] = $i;
            // console_log("ansTxt = $ansTxt[$i]");
            // console_log("ansTxtFRA = $ansTxtFRA[$i]");
            // console_log("ansId = $ansId[$i]");
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
    <script src="../js/jquery-3.4.1.min.js"></script>
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
                        <p>Please fill this form and submit to update question record in the database.</p>
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
                            <label>Question Topic: <?php echo $topicid; ?></label>  
                            <select id="topicid" name="topicid" class="form-control <?php echo (!empty($topicid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $topicid; ?>">
                                <?php foreach ($topicsList as $key => $value) { 
                                    # read all topics from associative arrrat - list all topics
                                    echo ' <option value="'.$key.'">'.$value.'</option>';
                                } ?>
                            </select>
                                                                     
                            <span class="invalid-feedback"><?php echo $topicid_err;?></span>
                        </div>
                        <hr /><hr />
                        <table style="width: 100%;"> 
                        <tr>
                            <td>
                                <h3>Answers section (FRA): </h3>
                            </td>
                            <td>
                                <h3>Answers section (ENG): </h3>
                            </td>
                        </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input name="answer1FRA_id" id="answer1FRA_id" value="<?php echo $ansId[0]; ?>" type="hidden"> 
                                        <label for="answer1FRA">Repondre-1: </label>
                                        <textarea name="answer1FRA" id="answer1FRA" value="<?php echo $answer1FRA;?>"
                                        class="form-control <?php echo (!empty($answer1FRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer1FRA; ?></textarea>
                                        <span class="invalid-feedback"><?php echo $answer1FRA_err;?></span>
                                    </div> 
                                </td>
                                <td>
                                <div class="form-group">
                                    <input name="answer1ENG_id" id="answer1ENG_id" value="<?php echo $ansId[0]; ?>" type="hidden"> 
                                        <label for="answer1ENG">Answer-1:</label>
                                        <textarea name="answer1ENG" id="answer1ENG" value="<?php echo $answer1ENG;?>"
                                        class="form-control <?php echo (!empty($answer1ENG_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer1ENG; ?></textarea>
                                        <span class="invalid-feedback"><?php echo $answer1ENG_err;?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input name="answer2FRA_id" id="answer2FRA_id" value="<?php echo $ansId[1]; ?>" type="hidden"> 
                                        <label for="answer2FRA">Repondre-2: </label> 
                                        <textarea name="answer2FRA" id="answer2FRA" value="<?php echo $answer2FRA;?>"
                                        class="form-control <?php echo (!empty($answer2FRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer2FRA; ?></textarea>                                         
                                        <span class="invalid-feedback"><?php echo $answer2FRA_err;?></span>
                                    </div>
                                </td>
                                <td>
                                <div class="form-group">
                                        <input name="answer2ENG_id" id="answer2ENG_id" value="<?php echo $ansId[1]; ?>" type="hidden">
                                        <label for="answer2ENG">Answer-2:</label>
                                        <textarea name="answer2ENG" id="answer2ENG" value="<?php echo $answer2ENG;?>"
                                        class="form-control <?php echo (!empty($answer2ENG_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer2ENG; ?></textarea>
                                        <span class="invalid-feedback"><?php echo $answer2ENG_err;?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input name="answer3FRA_id" id="answer3FRA_id" value="<?php echo $ansId[2]; ?>" type="hidden"> 
                                        <label  for="answer3FRA">Repondre-3:</label>     
                                        <textarea name="answer3FRA" id="answer3FRA" value="<?php echo $answer3FRA;?>"
                                        class="form-control <?php echo (!empty($answer3FRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer3FRA; ?></textarea>
                                        <span class="invalid-feedback"><?php echo $answer3FRA_err;?></span>
                                    </div>
                                </td>
                                <td>
                                <div class="form-group">
                                        <input name="answer3ENG_id" id="answer3ENG_id" value="<?php echo $ansId[2]; ?>" type="hidden">
                                        <label for="answer3ENG">Answer-3:</label>
                                        <textarea name="answer3ENG" id="answer3ENG" value="<?php echo $answer3ENG;?>"
                                        class="form-control <?php echo (!empty($answer3ENG_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer3ENG; ?></textarea>
                                        <span class="invalid-feedback"><?php echo $answer3ENG_err;?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="form-group">
                                        <input name="answer4FRA_id" id="answer4FRA_id" value="<?php echo $ansId[3]; ?>" type="hidden"> 
                                        <label  for="answer4FRA">Repondre-4:</label> 
                                        <textarea name="answer4FRA" id="answer4FRA" value="<?php echo $answer4FRA;?>"
                                        class="form-control <?php echo (!empty($answer4FRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer4FRA; ?></textarea>
                                        <span class="invalid-feedback"><?php echo $answer4FRA_err;?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input name="answer4_id" id="answer4ENG_id" value="<?php echo $ansId[3]; ?>" type="hidden">
                                        <label for="answer4ENG">Answer-4:</label>
                                        <textarea name="answer4ENG" id="answer4ENG" value="<?php echo $answer4ENG;?>"
                                        class="form-control <?php echo (!empty($answer4ENG_err)) ? 'is-invalid' : ''; ?>"><?php echo $answer4ENG; ?></textarea>
                                        <span class="invalid-feedback"><?php echo $answer4ENG_err;?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;"><hr /><h4>Select valid answer:</h4></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="validAnsRadBtn" style="text-align:center;">
                                    <input name="validAnswer" id="validAnswer" type="hidden"> 
                                        <fieldset name="validAnsFRA" id="validAnsFRA" >
                                            <div class="validAnsRadBtn">
                                                <label>1):&nbsp;&nbsp;&nbsp;<input type="radio" id="answer1FRAValid" name="validAnsFRA" value="<?php echo $ansId[0];?>"
                                                <?php if ($ansValid[0] == 1) { echo 'checked="true"'; } ?>" />
                                                </label>
                                            </div>
                                            <div class="validAnsRadBtn">
                                                <label>2):&nbsp;&nbsp;&nbsp;<input type="radio" id="answer2FRAValid" name="validAnsFRA" value="<?php echo $ansId[1];?>"
                                                <?php if ($ansValid[1] == 1) { echo 'checked="true"'; } ?>" />
                                                </label>
                                            </div>
                                            <div class="validAnsRadBtn">
                                                <label>3):&nbsp;&nbsp;&nbsp;<input type="radio" id="answer3FRAValid" name="validAnsFRA" value="<?php echo $ansId[2];?>"
                                                <?php if ($ansValid[2] == 1) { echo 'checked="true"'; } ?>" />
                                                </label>
                                            </div>
                                            <div class="validAnsRadBtn">
                                                <label>4):&nbsp;&nbsp;&nbsp;<input type="radio" id="answer4FRAValid" name="validAnsFRA" value="<?php echo $ansId[3];?>"
                                                <?php if ($ansValid[3] == 1) { echo 'checked="true"'; } ?>" />
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <hr />
                        <div style="text-align:center;">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="landingQTable.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                        
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <script type="text/JavaScript">
        document.getElementById("topicid").value='<?php echo $topicid ?>';

        $('#validAnsFRA input:radio').on('change', function() {
            var value = $(this).val();
            document.getElementById("validAnswer").value = value;
            console.log("validAnswer: ",value);      
        });
        function changeValidAnswer() {
            var validAnswer = document.getElementById("validAnsFRA").value;
            console.log("validAnswer = ", validAnswer);
        }
    </script> 
</body>
</html>