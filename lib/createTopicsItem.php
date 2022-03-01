<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// create Topics Records
$titleENG = $titleFRA = $active = "";
$input_titleENG = $input_titleFRA = $input_active = "";
$titleENG_err = $titleFRA_err = $active_err = "";

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
    // Validate question Text: titleENG
    $input_titleENG = trim($_POST["titleENG"]);
    if(empty($input_titleENG)){
        $titleENG_err = "Please enter a titleENG.";
    
    } else{
        $titleENG = $input_titleENG;
    }
     
    // Validate titleFRA
    $input_titleFRA = trim($_POST["titleFRA"]);
    if(empty($input_titleFRA)){
        $titleFRA_err = "Please enter the titleFRA";     
    // } elseif(!ctype_digit($input_salary)){
    //     $salary_err = "Please enter a positive integer value.";
    } else{
        $titleFRA = $input_titleFRA;
    }

    $input_active = trim($_POST["active"]);
    if(empty($input_active)){
        $active_err = "Please enter the active state";    
    } else{
        $active = $input_active;
    }
    // // Validate topicid
    // $input_topicid = trim($_POST["topicid"]);
    // if(empty($input_topicid)){
    //     $topicid_err = "Please enter the topicid";     
    // } elseif(!ctype_digit($input_topicid)){
    //     $topicid_err = "Please enter a positive integer value.";
    //     $topicid = "";
    // } else{
    //     $topicid = $input_topicid;
    // }
    
    // Check input errors before inserting in database
    if(!empty($input_titleENG) && !empty($input_titleFRA)){
              
        // Prepare an insert statement
        $sql = "INSERT INTO topicslist (titleENG, titleFRA, active) VALUES (?, ?, ?)";
        console_log("sql: " . $sql) ;
        if($stmt = mysqli_prepare($connection, $sql)){
            console_log("Function mysqli_prepare successfully executed!");
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", 
                        $param_titleENG, $param_titleFRA, $active);
            // Set parameters
            $param_titleENG = $titleENG;
            $param_titleFRA = $titleFRA;
            $param_active = $active;
            
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
                header("location: landingTopicsTable.php");
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
    <title>Create New Topics Title Record</title>
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
                    <p>Please fill this form and submit to add new Topics Title record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Topics Title Text (ENG)</label>
                            <textarea name="titleENG" 
                            class="form-control <?php echo (!empty($titleENG_err)) ? 'is-invalid' : ''; ?>"><?php echo $titleENG; ?></textarea>
                            <span class="invalid-feedback"><?php echo $titleENG_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Topics Title Text (FRA)</label>
                            <textarea name="titleFRA" 
                            class="form-control <?php echo (!empty($titleFRA_err)) ? 'is-invalid' : ''; ?>"><?php echo $titleFRA; ?></textarea>
                            <span class="invalid-feedback"><?php echo $titleFRA_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Is Topic Active</label>                        
                            <select id="active" name="active" class="form-control <?php echo (!empty($active_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $active; ?>">
                                <option value="1">active</option>
                                <option value="0">deactivated</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $active_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">

                        <a href="landingTopicsTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
                <div class="col-md-12" id="messageDiv">
                    <div id="message">
                        <a href="createTopicsItem.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Add Another Record</a>
                        &nbsp; &nbsp; &nbsp;
                        <a href="landingTopicsTable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>