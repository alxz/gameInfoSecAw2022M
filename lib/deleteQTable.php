<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to update a record in the table:
// Define variables and initialize with empty values
$qTxt = $questionurl = $qTxtFRA = $questionurlFRA = $topicid = "";
$input_qTxt = $input_questionurl = $input_qTxtFRA = $input_questionurlFRA = $input_topicid = "";
$qTxt_err = $questionurl_err = $qTxtFRA_err = $questionurlFRA_err = $topicid_err = "";
$tabName = "tabquestions"; // set the name of the table where we have all questions stored
$id = $innerHTMLtblSrc = "";

$answer1FRA = $answer2FRA = $answer3FRA = $answer4FRA = "";
$answer1ENG = $answer2ENG = $answer3ENG = $answer4ENG = "";
$answer1Valid = $answer2Valid = $answer3Valid = $answer4Valid = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $param_id = trim($_POST["id"]);
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
        
    // Check input errors before inserting in database
    if(!empty($param_id)){
            // Prepare a delete statement
            $sqlAnsw = "DELETE FROM tabanswers WHERE ansQId = ?";            
            if($stmt = mysqli_prepare($connection, $sqlAnsw)){                
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);                
                // Attempt to execute the prepared statement
                $rc = mysqli_stmt_execute($stmt);
                if( $rc === true ){
                    console_log("Answers records had been successfuly removed!") ;              
                    // header("location: landingAnswersTable.php");
                    // exit();
                } else{
                    echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />"; 
                    console_log("Error deleting the record in a dataTables:\n". htmlspecialchars($stmt->error));
                    if ( false===$rc ) {
                        die('execute() failed: ' . htmlspecialchars($stmt->error));
                    }
                }
                $rc = "";
                // Close statement
                mysqli_stmt_close($stmt);
                $stmt="";
            }      
        }    
        
        // Prepare a delete statement
        $sql = "DELETE FROM tabquestions WHERE qId = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            // $errStr = htmlspecialchars($stmt->error);
            
            // Attempt to execute the prepared statement
            $rc = mysqli_stmt_execute($stmt);
            if( $rc === true ){
                console_log("Record has been successfuly deleted!") ;              
                header("location: landingQTable.php");
                exit();
            } else{
                echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />";                
                
                console_log("Error deleting the record in a dataTables:\n". htmlspecialchars($stmt->error));
                if ( false===$rc ) {
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
    }        
    // Close connection
    mysqli_close($connection);
} else {
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Prepare a select statement
        $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
        $sql = "SELECT tbl1.*, tbl2.titleENG, tbl2.titleFRA FROM tabquestions as tbl1, topicslist as tbl2 WHERE tbl1.qId = ? AND tbl1.topicid = tbl2.topicid;";
        $all_property = array();
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);        
            // Set parameters
            $param_id = trim($_GET["id"]);
            $questionId = $param_id;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);        
                if(mysqli_num_rows($result) > 0){                                                                                  
                    $innerHTMLtblSrc .= '<table class="table table-bordered table-striped">';
                        while ($property = mysqli_fetch_field($result)) {                            
                            // echo '<th>' . $property->name . '</th>';  //get field name for header    
                            array_push($all_property, $property->name);  //save those to array
                        }                    
                    $innerHTMLtblSrc .= '<tbody>';
                    while ($row = mysqli_fetch_array($result)) {                        
                        foreach ($all_property as $item) {
                            if ( strtolower($item) == "qistaken" || strtolower($item) == "qisanswered" ) {
                                # we skip these fields
                            } else {
                                $innerHTMLtblSrc .= "<tr>"; 
                                $innerHTMLtblSrc .= '<th>' . $item . '</th>';  //get field name for header                                    
                                $innerHTMLtblSrc .= '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
                                $innerHTMLtblSrc .= '</tr>'; 
                            }                                                                                         
                        }                        
                    }
                    $innerHTMLtblSrc .= '</tbody></table>';
                    // Free result set
                    mysqli_free_result($result);
                    $innerHTMLtblSrc .= "<hr/><h3>Answers:</h3>";
                    $sqlAns = "SELECT * FROM `tabanswers`  WHERE ansQId=? ORDER BY `tabanswers`.`ansQId` ASC;";
                    $allAns_property = array();
                    if($stmtAns = mysqli_prepare($connection, $sqlAns)){ 
                        mysqli_stmt_bind_param($stmtAns, "i", $param_ansQId);
                        $param_ansQId = $questionId;
                        if(mysqli_stmt_execute($stmtAns)){
                            $resultAns = mysqli_stmt_get_result($stmtAns);
                            if(mysqli_num_rows($resultAns) > 0){ 
                                $innerHTMLtblSrc .= '<table class="table table-bordered table-striped">';
                                while ($property = mysqli_fetch_field($resultAns)) {                            
                                    // echo '<th>' . $property->name . '</th>';  //get field name for header    
                                    array_push($allAns_property, $property->name);  //save those to array
                                }                    
                            $innerHTMLtblSrc .= '<tbody>';
                            $qIndex = 0;
                            while ($row = mysqli_fetch_array($resultAns)) { 
                                
                                $qIndex++;
                                    $innerHTMLtblSrc .= "<tr>"; 
                                    $innerHTMLtblSrc .= '<th>Anser# '. $qIndex.' :</th>';  //get field name for header                                    
                                    $innerHTMLtblSrc .= '<td class="editpage-data-table"></td>'; //get items using property value
                                    $innerHTMLtblSrc .= '</tr>';                      
                                foreach ($allAns_property  as $item) {                                
                                    if ( strtolower($item) == "ansid" || strtolower($item) == "ansqid" ) {
                                        # we skip these fields.
                                    } elseif ( strtolower($item) == "ansisvalid") {
                                        $innerHTMLtblSrc .= "<tr>"; 
                                        $innerHTMLtblSrc .= '<th>' . 'Is Correct?' . '</th>';  //get field name for header                                    
                                        $innerHTMLtblSrc .= '<td class="editpage-data-table">' 
                                                            . ($row[$item] == '1' ? '<spawn style="color:red;font-weight: bold;">Correct</spawn>' : 'Incorrect' )
                                                            . '</td>'; //get items using property value
                                        $innerHTMLtblSrc .= '</tr>';
                                    } else {
                                        $innerHTMLtblSrc .= "<tr>"; 
                                        $innerHTMLtblSrc .= '<th>' . $item . '</th>';  //get field name for header                                    
                                        $innerHTMLtblSrc .= '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
                                        $innerHTMLtblSrc .= '</tr>'; 
                                    }                                                                                                 
                                }
                                    $innerHTMLtblSrc .= "<tr>"; 
                                    $innerHTMLtblSrc .= '<th> </th>';  //get field name for header                                    
                                    $innerHTMLtblSrc .= '<td class="editpage-data-table"></td>'; //get items using property value
                                    $innerHTMLtblSrc .= '</tr>';                         
                            }
                            $innerHTMLtblSrc .= '</tbody></table>';
                            // Free result set
                            mysqli_free_result($resultAns);
                            }
                        }
                    }

                } else{
                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                }
            } else{
                echo "<hr /> &nbsp; &nbsp; Oops! Something went wrong. Please try again later.<hr />";
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
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <p><?php echo $innerHTMLtblSrc; ?></p>
                    </div>
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this question record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="landingQTable.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>