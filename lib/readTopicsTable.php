<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');

// A script to creaste a record in the table:
// Define variables and initialize with empty values
// $qTxt = $questionurl = $qTxtFRA = $questionurlFRA = $topicid = "";
// $input_qTxt = $input_questionurl = $input_qTxtFRA = $input_questionurlFRA = $input_topicid = "";
// $qTxt_err = $questionurl_err = $qTxtFRA_err = $questionurlFRA_err = $topicid_err = "";
$innerHTMLtblSrc = "";
$topicid = "";
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Prepare a select statement
    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
    $sql = "SELECT * FROM topicslist as tbl1 WHERE tbl1.topicid = ?;";
    $all_property = array();
    if($stmt = mysqli_prepare($connection, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);        
        // Set parameters
        $param_id = trim($_GET["id"]);
        $topicid = $param_id;
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
                        $innerHTMLtblSrc .= "<tr>"; 
                        $innerHTMLtblSrc .= '<th>' . $item . '</th>';  //get field name for header                                    
                        $innerHTMLtblSrc .= '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
                        $innerHTMLtblSrc .= '</tr>';                                                                  
                    }                        
                }
                $innerHTMLtblSrc .= '</tbody></table>';
                // Free result set
                mysqli_free_result($result);
            } else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
        } else{
            echo "<hr /> &nbsp; &nbsp; Oops! Something went wrong. Please try again later.<hr />";
        }        
        // Attempt to execute the prepared statement
        // if(mysqli_stmt_execute($stmt)){
        //     $result = mysqli_stmt_get_result($stmt);    
        //     if(mysqli_num_rows($result) == 1){
        //         /* Fetch result row as an associative array. Since the result set
        //         contains only one row, we don't need to use while loop */
        //         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
        //         // Retrieve individual field value
        //         $qTxt = $row["qTxt"];
        //         $questionurl = $row["questionurl"];
        //         $qTxtFRA = $row["qTxtFRA"];
        //         $questionurlFRA = $row["questionurlFRA"];
        //     } else{
        //         // URL doesn't contain valid id parameter. Redirect to error page
        //         header("location: error.php");
        //         exit();
        //     }            
        // } else{
        //     echo "Oops! Something went wrong. Please try again later.";
        // }
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read Topics Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>    
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Topic Record #<?php echo $topicid; ?></h1> 
                    <div class="form-group">
                        <label>Data as it presented in the table:</label>
                        <p><b><?php echo $innerHTMLtblSrc; ?></b></p>
                    </div>
                    
                    <p><a href="landingTopicsTable.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>