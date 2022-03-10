<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to create a record in the table:
// Define variables and initialize with empty values
$topicsList = [];
$tabName = "tabquestions";
$qTxt = $questionurl = $qTxtFRA = $questionurlFRA = $topicid = "";
$input_qTxt = $input_questionurl = $input_qTxtFRA = $input_questionurlFRA = $input_topicid = "";
$qTxt_err = $questionurl_err = $qTxtFRA_err = $questionurlFRA_err = $topicid_err = "";
$param_ansTxt = $param_ansIsValid = $param_ansTxtFRA = $param_ansId = "";
$answer1FRA = $answer2FRA = $answer3FRA = $answer4FRA = "";
$answer1ENG = $answer2ENG = $answer3ENG = $answer4ENG = "";
$answer1Valid = $answer2Valid = $answer3Valid = $answer4Valid = "";
$answer1ENG_err = $answer2ENG_err = $answer3ENG_err = $answer4ENG_err = "";
$answer1FRA_err = $answer2FRA_err = $answer3FRA_err = $answer4FRA_err = "";
$last_id = ""; // last inserted Question-ID
$sqlAns1 = $sqlAns2 = $sqlAns3 =$sqlAns4 = "";
$ansTxt = [];
$ansTxtFRA = [];
$ansValid = []; $ansValid[0] = 0; $ansValid[1] = 0; $ansValid[2] = 0; $ansValid[3] = 0;
$ansId = [];

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
            $param_topicid = $topicid;
            //$param_id = $id;
            $errStr = htmlspecialchars($stmt->error);            
            // Attempt to execute the prepared statement
            $rc = mysqli_stmt_execute($stmt);

            if( $rc === true ) {
                $last_id = mysqli_insert_id($connection);
                echo "New record created successfully. Last inserted ID is: " . $last_id;
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
              }

            if( $rc === true ){
                console_log("Record has been successfuly inserted!") ;
                // Records created successfully. Redirect to landing page
                // echo `
                // <script type="text/JavaScript">
                //     document.getElementById("messageDiv").style.display = "block";
                //     document.getElementById("createRcFields").style.display = "none";
                // </script>`;               
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
        $ansQId  = $last_id;
        console_log("answerID - last inserted id = ". $ansQId);
        //$sql = "INSERT INTO tabquestions (qTxt, questionurl, qTxtFRA, questionurlFRA, topicid) VALUES (?, ?, ?, ?, ?)";
        for ($i=0; $i < 4; $i++) { 
            $sqlAns = "INSERT INTO tabanswers (ansTxt, ansQId, ansIsValid, ansTxtFRA) VALUES (?, ?, ?, ?);";
            // console_log("Prepare Statement ".$sqlAns) ;
            if($stmtStr[$i] = mysqli_prepare($connection, $sqlAns)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmtStr[$i], "siis", 
                            $param_ansTxt, $param_ansQId, $param_ansIsValid, $param_ansTxtFRA);
                // Set parameters
                $param_ansTxt = $ansTxt[$i];
                $param_ansTxtFRA = $ansTxtFRA[$i];
                $param_ansQId = $ansQId;
                // $ansId = $ansValid = [1,2,3,4];
                if ($ansId[$i] == $validAns) {
                    $param_ansIsValid = 1;
                    console_log("Checking param_ansIsValid[$i] = $param_ansIsValid");
                } else {
                    $param_ansIsValid = 0;
                }    
                // console_log("Checking ansId[$i] = $ansId[$i]");                        
                // $param_ansId = $ansId[$i];

                //console_log("Params: $param_ansTxt, $param_ansTxtFRA, $param_ansIsValid, $param_ansId");
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
        
        $sql = "SELECT * FROM topicslist WHERE active=1 ORDER BY topicid ASC;";
        // console_log("ConsoleLOG:  " . $sql); //$result = mysqli_query($connection,$sql); // $result = mysqli_query($link, $sql)
        if ( $result = mysqli_query($connection,$sql) ){
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
                            
                          } else {
                            
                            //echo '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
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
        // Close connection
        mysqli_close($connection);
        $ansId = $ansValid = [1,2,3,4];
        foreach ($ansId as $thisId) {
            console_log("AnswerId = ".$thisId);
        }
        foreach ($ansValid as $thisId) {
            $strVal = $thisId ? 'true' : 'false';
            console_log("ansValid = ".$strVal);
        }
        
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Question and Answers Record</title>
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
                    <h2 class="mt-5">Create New Question with 4-Answers Record</h2>
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
                                <?php foreach ($topicsList as $key => $value) {
                                    # list all topics
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