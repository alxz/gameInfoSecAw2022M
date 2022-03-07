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
$answer1Valid = true; $answer2Valid = $answer3Valid = $answer4Valid = false;
$sqlAns1 = $sqlAns2 = $sqlAns3 =$sqlAns4 = "";
$ansTxt = [];
$ansTxtFRA = [];
$ansValid = [];
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

        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }

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
                
                header("location: landingQTable.php");
                exit();
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
        
        $stmtStr = [];
        $ansTxtFRA[0] = $answer1FRA;
        $ansTxtFRA[1] = $answer2FRA; 
        $ansTxtFRA[2] = $answer3FRA; 
        $ansTxtFRA[3] = $answer4FRA;
        $ansTxt[0] = $answer1ENG;
        $ansTxt[1] = $answer2ENG; 
        $ansTxt[2] = $answer3ENG;
        $ansTxt[3] = $answer4ENG;
        $ansValid[0] = $answer1FRAValid;
        $ansValid[1] = $answer2FRAValid;
        $ansValid[2] = $answer3FRAValid;
        $ansValid[3] = $answer4FRAValid;

        for ($i=0; $i < 4; $i++) { 
            $sqlAns = "UPDATE tabanswers SET ansTxt=?, ansTxtFRA=?, ansIsValid=? WHERE ansId=?";
            console_log("Prepare Statement ".$sqlAns) ;
            if($stmtStr[$i] = mysqli_prepare($connection, $sqlAns)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssii", 
                            $param_ansTxt, $param_ansTxtFRA, $param_ansIsValid, $param_ansId);
                // Set parameters
                $param_ansTxt = $ansTxt[$i];
                $param_ansTxtFRA = $ansTxtFRA[$i];
                $param_ansIsValid = $ansValid[$i];            
                $param_ansId = $ansId[$i];
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
                    $allVars = get_defined_vars();
                    print_r($allVars);
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
                   
        for ($i=0; $i < 4; $i++) { 
            $ansTxt[$i] = "";
            $ansTxtFRA[$i] = "";
            $ansValid[$i] = 0;
            $ansId[$i] = $i;
            console_log("ansTxt = $ansTxt[$i]");
            console_log("ansTxtFRA = $ansTxtFRA[$i]");
            console_log("ansId = $ansId[$i]");
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
        $sqlAns = "SELECT * FROM `tabanswers`  WHERE ansQId=? ORDER BY `tabanswers`.`ansQId` ASC;";    
        
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
                            $ansValid[$qIndex] = ($row[$item] == '1' ? true : false ); //get items using property value
                           
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
                        <hr />
                        <h3>Answers section (FRA): </h3> 
                        <table style="width: 100%;"> 
                            <tr>
                                <td style="width: 85%;">
                                    <div class="form-group">
                                        <label for="answer1FRA">Repondre-1 (FRA / ansId: <?php echo $ansId[0]; ?>): </label>                                        
                                        <input type="text" name="answer1FRA" id="answer1FRA"
                                        class="form-control <?php echo (!empty($answer1FRA_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer1FRA; ?>"/>
                                        <span class="invalid-feedback"><?php echo $answer1FRA_err;?></span>
                                    </div>                        
                                    <div class="form-group">
                                        <label for="answer2FRA">Repondre-2 (FRA / ansId: <?php echo $ansId[1]; ?>): </label>                                        
                                        <input type="text" name="answer2FRA" id="answer2FRA"
                                        class="form-control <?php echo (!empty($answer2FRA_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer2FRA; ?>"/>
                                        <span class="invalid-feedback"><?php echo $answer2FRA_err;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label  for="answer3FRA">Repondre-3 (FRA / ansId: <?php echo $ansId[2]; ?>)</label>                                        
                                        <input type="text" name="answer3FRA" id="answer3FRA"
                                        class="form-control <?php echo (!empty($answer3FRA_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer3FRA; ?>"/>
                                        <span class="invalid-feedback"><?php echo $answer3FRA_err;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label  for="answer4FRA">Repondre-4 (FRA / ansId: <?php echo $ansId[3]; ?>)</label>                                        
                                        <input type="text" name="answer4FRA" id="answer4FRA"
                                        class="form-control <?php echo (!empty($answer4FRA_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer4FRA; ?>"/>
                                        <span class="invalid-feedback"><?php echo $answer4FRA_err;?></span>
                                    </div>
                                </td>
                                <td style="width: 15%; text-align:center;">
                                Valid:<br>
                                <div class="validAnsRadBtn" >
                                    <fieldset name="validAnsFRA" id="validAnsFRA" >
                                    <div class="validAnsRadBtn">
                                        <label>1:&nbsp;<input type="radio" id="answer1FRAValid" name="validAnsFRA" value="<?php echo $ansId[0];?>"
                                        <?php if ($ansValid[0]) { echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    <div class="validAnsRadBtn">
                                        <label>2:&nbsp;<input type="radio" id="answer2FRAValid" name="validAnsFRA" value="<?php echo $ansId[1];?>"
                                        <?php if ($ansValid[1]) { echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    <div class="validAnsRadBtn">
                                        <label>3:&nbsp;<input type="radio" id="answer3FRAValid" name="validAnsFRA" value="<?php echo $ansId[2];?>"
                                        <?php if ($ansValid[2]) { echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    <div class="validAnsRadBtn">
                                        <label>4:&nbsp;<input type="radio" id="answer4FRAValid" name="validAnsFRA" value="<?php echo $ansId[3];?>"
                                        <?php if ($ansValid[3]) { echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    </fieldset>
                                </div>
                                </td>
                            </tr>
                            </table>
                        <hr />
                        <h3>Answers section (ENG): </h3>
                        <table style="width: 100%;"> 
                            <tr>
                                <td style="width: 85%;">
                                    <div class="form-group">
                                        <label for="answer1ENG">Answer-1 (ENG / ansId: <?php echo $ansId[0]; ?>)</label>
                                        <input type="text" name="answer1ENG" id="answer1ENG"
                                        class="form-control <?php echo (!empty($answer1ENG_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer1ENG; ?>">
                                        <span class="invalid-feedback"><?php echo $answer1ENG_err;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer2ENG">Answer-2 (ENG / ansId: <?php echo $ansId[1]; ?>)</label>
                                        <input type="text" name="answer2ENG" id="answer2ENG" 
                                        class="form-control <?php echo (!empty($answer2ENG_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer2ENG; ?>">
                                        <span class="invalid-feedback"><?php echo $answer2ENG_err;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer3ENG">Answer-3 (ENG / ansId: <?php echo $ansId[2]; ?>)</label>
                                        <input type="text" name="answer3ENG" id="answer3ENG" 
                                        class="form-control <?php echo (!empty($answer3ENG_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer3ENG; ?>">
                                        <span class="invalid-feedback"><?php echo $answer3ENG_err;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer4ENG">Answer-4 (ENG / ansId: <?php echo $ansId[3]; ?>)</label>
                                        <input type="text" name="answer4ENG" id="answer4ENG" 
                                        class="form-control <?php echo (!empty($answer4ENG_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer4ENG; ?>">
                                        <span class="invalid-feedback"><?php echo $answer4ENG_err;?></span>
                                    </div>
                                </td>
                                <td style="width: 15%; text-align:center;">
                                Valid:<br>
                                <div class="validAnsRadBtn" >
                                    <fieldset name="validAnsENG" id="validAnsENG" >
                                    <div class="validAnsRadBtn">
                                        <label>1:&nbsp;<input type="radio" id="answer1ENGValid" name="validAnsENG" value="<?php echo $ansId[0];?>" 
                                        <?php if ($ansValid[0]) { echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    <div class="validAnsRadBtn">
                                        <label>2:&nbsp;<input type="radio" id="answer2ENGValid" name="validAnsENG" value="<?php echo $ansId[1];?>" 
                                        <?php if ($ansValid[1]) {echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    <div class="validAnsRadBtn">
                                        <label>3:&nbsp;<input type="radio" id="answer3ENGValid" name="validAnsENG" value="<?php echo $ansId[2];?>"
                                        <?php if ($ansValid[2]) { echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    <div class="validAnsRadBtn">
                                        <label>4:&nbsp;<input type="radio" id="answer4ENGValid" name="validAnsENG" value="<?php echo $ansId[3];?>"
                                        <?php if ($ansValid[3]) { echo 'checked="true"'; } ?>" />
                                        </label>
                                    </div>
                                    </fieldset>
                                </div>
                                </td>
                            </tr>
                            </table>
                        <hr />
                        <input type="submit" class="btn btn-primary" value="Submit">

                        <a href="landingQTable.php" class="btn btn-secondary ml-2">Cancel</a>
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