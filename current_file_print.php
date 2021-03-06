<?php
     session_start();
     if(!isset($_SESSION['usrnm'])){
        header("Location:index.html");
     }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>new</title>
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="../bootstrap/css/bootstrap3.min.css">
      <link rel="stylesheet" type="text/css" href="../bootstrap/css/glyphicon.css">
      <!-- jquery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

      <!-- bootstrap -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <style>
            #customers {
              font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 75%;

            }

            #customers td, #customers th {
              border: 1px solid #ddd;
              padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #87ceeb;}

            #customers th {
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: #4CAF50;
              color: white;
            }
    </style>
    <!-- ancor tag -->
    <style>
        a:link, a:visited {
          background-color: #f44336;
          color: white;
          padding: 14px 25px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          transform: translateX(400px);
        }

        a:hover, a:active {
          background-color: green;
        }
</style>

</head>
<body>
</body>
</html>


<?php

include_once 'dbconnection.php';
    $link = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$results_per_page = 2;
// Attempt select query execution with order by clause
$sql = "SELECT * FROM character_certificate";
$result = mysqli_query($link, $sql);
$number_of_results = mysqli_num_rows($result);
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
$sql2='SELECT * FROM character_certificate LIMIT ' . $this_page_first_result . ',' .  $results_per_page;


if($result = mysqli_query($link, $sql2)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='customers'>";

        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<th>Category</th>";
                echo "<th>Info</th>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>Serial Number</td>";
                echo "<td>".$row["id"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>Name</td>";
                echo "<td>".$row["name"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>Fathers Name</td>";
                echo "<td>".$row["father_name"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>Mothers Name</td>";
                echo "<td>".$row["mother_name"]."</td>";
            echo "</tr>"; 
              
            echo "<tr>";
                echo "<td>House</td>";
                echo "<td>".$row["house"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>Road</td>";
                echo "<td>".$row["road"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>Block</td>";
                echo "<td>".$row["block"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>Village Name</td>";
                echo "<td>".$row["village"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>Post Office</td>";
                echo "<td>".$row["post_office"]."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>District</td>";
                echo "<td>".$row["district"]."</td>";
            echo "</tr>";
            echo "<br>";


            $delete = "print eng copy";
            echo "<tr><td>".$imgData['id']."</td><td><a href='update.php?id=".$imgData['id']."'>".$delete."</a></td></tr>";
        }
        echo "</table>";
        // Close result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// display the links to the pages
echo "<br>";
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="history.php?page=' . $page . '">' . $page . '</a> ';
}
// Close connection
mysqli_close($link);
?>