<?php
require_once('../lib/functions.php');
require_once('../lib/classes.php');
require_once('../lib/config.php');
/*
DB TABLES STRUCTURE:
SELECT `uId`, `uIUN`, `uFName`, `uLName`, `uRetryCount`, `uTimer`,
  `uTotalScore`, `uIsFinished`, `timestart`, `timefinish`, `listofquestions`,
  `comment` FROM `tabusers`
// `tabquestions` (`qId`, `qTxt`, `qIsTaken`, `qIsAnswered`, `questionurl`, `qTxtFRA`, `questionurlFRA`, `topicid`)
// `tabanswers` (`ansId`, `ansTxt`, `ansQId`, `ansIsValid`, `ansTxtFRA`)
// `topicslist` (`topicid`, `titleENG`, `titleFRA`, `active`) 
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View And Modify data for the project - display tables</title>
  <link rel="stylesheet" href="../css/style.css">  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/JavaScript">
      function SubmitForm(formId) {
          //var oForm = document.getElementById(formId);
          //tabName
          var resultsContainer = document.getElementById('tabName');
          var selectedValue = document.getElementById('tabsFromDB').value;
          resultsContainer.value = `${selectedValue}`;

      }
  </script>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<h1>Display Data: Show the content of a mySQL DB tables
<a href="../start.html" id="link" style="color: #FFFF00">... back to START-page</a></h1>
<div>
  <div>
    <p>Please select a table name to display: &nbsp;&nbsp;&nbsp;
    <select name="tabsFromDB" id="tabsFromDB" onchange="SubmitForm('');">
      <?php echo displayAllTAbles(); ?>
    </select>
    </p>
    <p>Selected name: &nbsp;<input type="text" id="tabName" value="tabquestions" name="tabName" /></p>
  </div>
  <div id="dbShow">
  </div>
</div>
<button type="submit" value="Submit Request" name="submit">Submit Request</button>
&nbsp; &nbsp; &nbsp;
<button onclick="history.go(-1);">Back </button>
&nbsp; &nbsp; &nbsp;<hr/><br>
<button type="submit" value="detailsShow" name="detailsShow">Detailed Info</button>
&nbsp; &nbsp; &nbsp;

<div id="divDetails" class="details-hidden" style="display: none;">
  <div id="dvInput" class="input-info">
    <p>UIN: &nbsp;<input type="text" id="userIUNVar" name="userIUNVar" /> &nbsp; Use % symbol to display all</p>
  </div>
  <div id="divButton">
    <button type="submit" value="getStat" name="getStat"> Get Statistics </button>
  </div>
</div>
</form>
<script type="text/JavaScript">
  function getUserData() {
    //console.log('userIUNVar');
    var userIUN = document.getElementById("userIUNVar").value;
    //alert('User name: ' + userIUN);
  }
</script>

<script type="text/JavaScript">
          
          // var resultsContainer = document.getElementById("dbShow");
          // resultsContainer.innerHTML = `${toDisplay}`;

          var selectedValue = document.getElementById('tabsFromDB').value;
          //alert ('selected: '+selectedValue);
          resultsContainer = document.getElementById('tabName');
          resultsContainer.value = selectedValue; //`${selectedValue}`;
</script>
</body>
</html>
<?php
//echo displayAllTAbles(); //displayAllTAbles - to place a selection of tables
function display()
{
  $outVar = "<br>";
    $tabName = $_POST['tabName'];
    $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);

    //test if connection failed
    if(mysqli_connect_errno()){
        die("connection failed: "
            . mysqli_connect_error()
            . " (" . mysqli_connect_errno()
            . ")");
    }
    //echo '<br> ... still alive<br>';
    //get results from database
    $query = "SELECT * FROM ".$tabName;
    if ( trim($tabName) == "tabquestions") { 
      # special case:
        $query = "SELECT tbl1.*, tbl2.titleENG FROM tabquestions as tbl1, topicslist as tbl2 WHERE tbl1.topicid = tbl2.topicid";
    }     
    $result = mysqli_query($connection,$query);
    $run = $connection->query($query) or die("Last error: {$connection->error}\n");
    $all_property = array();  //declare an array for saving property
    //echo '<br> ... still alive<br>';
    //showing property
    echo '<br><table class="editpage-data-table" ><tr class="data-heading">';  //initialize table tag
    while ($property = mysqli_fetch_field($result)) {
        echo '<td class="editpage-data-table">' . $property->name . '</td>';  //get field name for header
        array_push($all_property, $property->name);  //save those to array
    }
    echo '</tr>'; //end tr tag

    //showing all data
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        $colIndex = 0;
        foreach ($all_property as $item) {
          if ( $colIndex == 0 ) { // strtolower($item) == "qid"
            echo '<td class="editpage-data-table"><div id="divButton">'
              .'<button value="btn-q'
              .$row[$item]
              .'" name="btn-q'
              .$row[$item].'">EDIT#<br />'
              .$row[$item]
              .'</button></div></td>';
          } else {
            echo '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
          }
          $colIndex++; 
        }
        echo '</tr>';
    }
    echo "</table>";
    //echo $outVar;

}

function getUserDataPHP() {
  $outVar = "<br>";
    //$tabName = $_POST['tabName']; //tabusers
      $tabName = 'tabusers';

  $userID = $_POST['userIUNVar'];
//  $text="<script type='text/JavaScript'>document.writeln(document.getElementById('userIUNVar').innerHTML);</script>";

  echo 'userID: '.$userID.'<br>';
  echo 'Sorting ascending by less time elapsed time (column name is uTimer) and only those finished the task: <br>';
  $connection = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
  if(mysqli_connect_errno()){
      die("connection failed: "
          . mysqli_connect_error()
          . " (" . mysqli_connect_errno()
          . ")");
  }

  $query = "SELECT * FROM ".$tabName." WHERE uIsFinished=1 AND uIUN LIKE '".$userID."%'"." ORDER BY uTimer,uRetryCount,uTotalScore ASC";
  $result = mysqli_query($connection,$query);
  $run = $connection->query($query) or die("Last error: {$connection->error}\n");
  $all_property = array();  //declare an array for saving property
  //echo '<br> ... still alive<br>';
  //showing property
  echo '<br><table class="editpage-data-table" ><tr class="data-heading">';  //initialize table tag
  while ($property = mysqli_fetch_field($result)) {
      echo '<td class="editpage-data-table">' . $property->name . '</td>';  //get field name for header
      array_push($all_property, $property->name);  //save those to array
  }
  echo '</tr>'; //end tr tag

  //showing all data
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      foreach ($all_property as $item) {
          echo '<td class="editpage-data-table">' . $row[$item] . '</td>'; //get items using property value
      }
      echo '</tr>';
  }
  echo "</table>";


}


if(isset($_POST['submit'])) {
  display();
} elseif (isset($_POST['detailsShow'])) {
  //echo 'HellO!';
  //divDetails
  echo '<script type="text/JavaScript"> document.getElementById("divDetails").style.display = "";</script>';
  // echo '<script type="text/JavaScript">'
  //       .'document.getElementById("divButton").innerHTML = \'<button type="submit" value="getStat" name="getStat" onclick="getUserData()"> Get Statistics </button>\';</script>';
  // echo '<br/><hr/><br/>';
  //getUserDataPHP();

  // $("#finSubmit").unbind("click");
  // $("#finSubmit").bind("click", getUserData);

  //$varDetails = $_POST['detailsShow'];
  //var_dump(isset($varDetails));

}
if (isset($_POST['getStat'])) {
  // code...
  getUserDataPHP();
}


// if(isset($_POST['update']))
// {
//       $tabName = $_POST['tabName'];
//       echo '<br>Updating: $tabName<br>';
//       $qTxt = "";
//       $qIsTaken = 0;
//       $qIsAnswered = 0;
//       $questionURL = "";
//       // Create connection
//       $conn = createConnection (DBHOST, DBUSER, DBPASS, DBNAME);
//       // Check connection
//       if (!$conn) {
//           die("Connection failed: " . mysqli_connect_error());
//       }
//
//       $sql = "INSERT INTO $tabName (qTxt, qIsTaken, qIsAnswered, questionURL)
//       VALUES ('$qTxt', $qIsTaken, $qIsAnswered, $questionURL)";
//
//       if (mysqli_query($conn, $sql)) {
//           //echo "<br> New record created successfully <br>";
//           echo "INSERTED";
//       } else {
//         http_response_code(500);
//           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//       }
//
//       mysqli_close($conn);
//
// }
// if(isset($_POST['tabsFromDB'])) {
//   $selectionMade = $_POST['tabsFromDB'];
//   echo $selectionMade;
// }
?>
