<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
// console_log("SessionID: ".($_GET['adminSessionId']));
// console_log("UserID: ".(trim($_GET["admuserid"])));
// if(isset($_GET["admuserid"]) && !empty(trim($_GET["admuserid"])) 
//     && isset($_GET['adminSessionId']) )  {
//         try {
//             //code...
//             // Create connection
//             $conn = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
//             // Check connection
//             if (!$conn) {
//                 die("Connection failed: " . mysqli_connect_error());
//             }
//             $sessionID = $_GET['adminSessionId']; // sessionid
//             $admuserid = trim($_GET["admuserid"]);
//             $sql = "SELECT * FROM adminusers WHERE userid=? AND sessionid=?";
//             if($stmt = mysqli_prepare($conn, $sql)){ 
//                 mysqli_stmt_bind_param($stmt, "ss", $param_sessionID, $param_userid);
//                 $param_sessionID = $sessionID;
//                 $param_userid = $admuserid;
//                 $rc = mysqli_stmt_execute($stmt);
//                 if($rc ){  
//                    console_log("User Verified!!! Access granted!");
//                 }else{
//                     echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />";
//                     //console_log("Error: ".  mysqli_error($rc));
//                     // $allVars = get_defined_vars();
//                     // print_r($allVars);
//                     // debug_zval_dump($allVars); //debug_print_backtrace();
//                     console_log("Error validating user permissions:\n". htmlspecialchars($stmt->error));
//                     if ( false===$rc ) {
//                         die('execute() failed: ' . htmlspecialchars($stmt->error));
//                     }
//                 }                        
//             }

//         } catch (\Throwable $th) {
//             //throw $th;
//             console_log("Error: ".$th);
//             mysqli_stmt_close($stmt);
//         } 
    
// } else {
    
//     echo "<br /> <hr /> Oops! Something went wrong. Please try again later. <hr />";
//                     //console_log("Error: ".  mysqli_error($rc));
//                     // $allVars = get_defined_vars();
//                     // print_r($allVars);
//                     // debug_zval_dump($allVars); //debug_print_backtrace();
//                     console_log("Error validating user permissions");
//                     die("Error validating user permissions! " );
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard DataBase Users Table</title>
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
            margin-left: 10px;
            margin-right: auto;
            max-width: 900px; /* 2 */
        }
        table tr td:last-child{
            width: 120px;
        }
        table td{
            width: 20px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<form action="../rest/getUSER.php" method="POST" id="usersdashboard-form" name="usersdashboard-form" >
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Users Table Details</h2>    
                        <div class="pull-right">                                
                            <div class="openPageBtnDiv">
                                <a href="../rest/exportUsers.php" class="btn btn-success pull-right" style="margin-right: 5px; margin-left: 5px;">                        
                                    <i class="fa fa-plus"></i>&nbsp;Export to CSV&nbsp;</a>
                            </div>                   
                        </div>
                        
                    </div>
                    <?php
                    // Include config file                    
                    // Attempt select query execution
                    $all_property = array();  //declare an array for saving property
                    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
                    $sql = "SELECT * FROM tabusers ORDER BY 10 DESC;";
                    // $sql = "SELECT * FROM tabquestions;";  // print_r ($sql); 
                    // console_log("ConsoleLOG:  " . $sql); //$result = mysqli_query($connection,$sql); // $result = mysqli_query($link, $sql)
                    if ( $result = mysqli_query($connection,$sql) ){
                        if(mysqli_num_rows($result) > 0){                                                                                  
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                    while ($property = mysqli_fetch_field($result)) {
                                        // we want to skip some columns: [sessionId]
                                        if ( strtolower($property->name) == strtolower("sessionId")) { // strtolower($item) == "uid"
                                            //we do not use these fields
                                        } elseif ( strtolower($property->name) == strtolower("uIsFinished")){
                                            //we want to change the name of these fields                                            
                                            echo '<th>' . "Is Game Finished?" . '</th>'; //save those to array
                                            array_push($all_property, $property->name);  //save those to array
                                        } elseif ( strtolower($property->name) == strtolower("uTimer")){
                                            //we want to change the name of these fields                                            
                                            echo '<th>' . "Time Spent (sec)" . '</th>'; //save those to array
                                            array_push($all_property, $property->name);  //save those to array
                                        } else {
                                            echo '<th>' . $property->name . '</th>';  //get field name for header
                                            array_push($all_property, $property->name);  //save those to array
                                        }
                                        
                                    }
                                    echo '<th>Action</th>';
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    foreach ($all_property as $item) {                                    
                                      echo '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value                                                                            
                                    }
                                    echo "<td>";
                                            echo '<a href="readUsrTable.php?id='. $row['uId'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            // echo '<a href="updateQTable.php?id='. $row['qId'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            // echo '<a href="deleteQTable.php?id='. $row['qId'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo '</tr>';
                                }
                                echo "</tbody>";                            
                            echo "</table>";
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
                    ?>
                </div>                
            </div>    
            <div class="col text-center">
                    <!-- <a href="createQTable.php" class="btn btn-success pull-right">
                                <i class="fa fa-plus"></i> Add New Record
                    </a> -->
            </div>    
        </div>
    </div>
</body>
</form>
</html>