<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// A script to update a record in the table:
// Define variables and initialize with empty values
$topicid = $titleENG = $titleFRA = $active = "";
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
    $input_titleENG = trim($_POST["titleENG"]);
    if(empty($input_titleENG)){
        $titleENG_err = "Please enter a Title in English.";
    // } elseif(!filter_var($input_qTxt, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $qTxt_err = "Please enter a valid qTxt.";
    } else{
        $titleENG = $input_titleENG;
    }

    $input_titleFRA = trim($_POST["titleFRA"]);
    if(empty($input_titleFRA)){
        $titleFRA_err = "Please enter a Title in French.";
    } else{
        $titleFRA = $input_titleFRA;
    }   
    //param_active  
    $active = trim($_POST["active"]);
     
    
    // Check input errors before inserting in database
    // $topicid =  $titleENG = $titleFRA = $active = "";
    // $param_topicid = $param_titleENG = $param_titleFRA = $param_active = "";
    // $titleENG_err = $titleFRA_err = $active_err = "";
    if(!empty($titleENG) && !empty($titleFRA)){            
        // Prepare an insert statement: "SELECT * FROM ".$tabName." WHERE topicid = ?";
        $sql = "UPDATE ".$tabName." SET titleENG=?, titleFRA=?, active=? WHERE topicid=?";
        // console_log("sql: " . $sql) ;

        if($stmt = mysqli_prepare($connection, $sql)){
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssii", 
                        $param_titleENG, $param_titleFRA, $param_active, $param_id);
            // Set parameters:            
            $param_titleENG = $titleENG;
            $param_titleFRA = $titleFRA;
            $param_active = $active;
            $param_id = $id;
            $errStr = htmlspecialchars($stmt->error);
            // Attempt to execute the prepared statement
            console_log("topicid = ".$topicid."; titleENG= ".$titleENG."; titleFRA= ".$titleFRA."; active= ".$active);
            $rc = mysqli_stmt_execute($stmt);
            if( $rc === true ){
                console_log("Record has been successfuly inserted!") ;      
                header("location: landingTopicsTable.php");
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
                console_log("topicid = ".$topicid."; titleENG= ".$titleENG."; titleFRA= ".$titleFRA."; active= ".$active);
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
                                <input name="id" id="id" value="<?php echo $id; ?>" type="hidden">
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
                                <option value="1">Active</option>'
                                <option value="0">Deactivated</option>'
                            </select>                                                                     
                            <span class="invalid-feedback"><?php echo $active_err;?></span>
                        </div>                       
                        <hr />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="landingTopicsTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <script type="text/JavaScript">
        document.getElementById("active").value='<?php echo $active ?>'
    </script> 
</body>
</html>