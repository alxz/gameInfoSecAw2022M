<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard DataBase Questions Topics Table</title>
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

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Topics Table Details</h2>
                        <a href="createTopicsItem.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Add New Record
                        </a>
                    </div>
                    <?php
                    // Include config file                    
                    // Attempt select query execution
                    $all_property = array();  //declare an array for saving property
                    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
                    $sql = "SELECT * FROM topicslist ORDER BY topicid DESC;";
                    // $sql = "SELECT * FROM tabquestions;";  // print_r ($sql); 
                    // console_log("ConsoleLOG:  " . $sql); //$result = mysqli_query($connection,$sql); // $result = mysqli_query($link, $sql)
                    if ( $result = mysqli_query($connection,$sql) ){
                        if(mysqli_num_rows($result) > 0){                                                                                  
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                    while ($property = mysqli_fetch_field($result)) {
                                        if ( strtolower($property->name) == "active" ) { 
                                            echo '<th>Is ' . $property->name . '?</th>';    
                                        } else {
                                            echo '<th>' . $property->name . '</th>';  //get field name for header  
                                        }                                           
                                        array_push($all_property, $property->name);  //save those to array
                                    }
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    foreach ($all_property as $item) {                                    
                                      if ( strtolower($item) == "active" ) {
                                          if ( $row[$item] == 0 || $row[$item] == "0") {
                                            echo "<td>" . "deactivated" . "</td>";
                                          } else {
                                            echo "<td>" . "active" . "</td>";
                                          }
                                        
                                      } else {
                                        echo '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
                                      }                                        
                                    }
                                    echo "<td>";
                                            echo '<a href="readTopicsTable.php?id='. $row['topicid'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="updateTopicsTable.php?id='. $row['topicid'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="deleteTopicsTable.php?id='. $row['topicid'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
                    <a href="createTopicsItem.php" class="btn btn-success pull-right">
                                <i class="fa fa-plus"></i> Add New Record
                    </a>
            </div>    
        </div>
    </div>
</body>
</html>