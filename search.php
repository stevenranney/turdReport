<?php

echo "<link rel='stylesheet' type='text/css' href='/css/simpleStyle.css'>";

//capture search term and remove spaces at its both ends if the is any
if (!empty($_POST["keyname"])) {
    $searchTerm = trim($_POST['keyname']);
} else echo "<script>alert('Please pass a name.')</script>";

    $configs = include('config.php');

    //database connection info
    $username = $configs['username'];
    $password = $configs['password'];
    $hostname = $configs['host']; 
    $database = $configs['database'];
    
 //connecting to server and creating link to database
$link = mysqli_connect($hostname, $username, $password, $database);

$escaped_searchTerm = mysqli_real_escape_string($link, $searchTerm);

//MYSQL search statement
$query = "SELECT * FROM testTable WHERE name = '$escaped_searchTerm'";

$results = mysqli_query($link, $query);

echo "<div class='wrap'>
    <div class='fleft'>";

if(mysqli_num_rows($results) >= 1){
        echo '<p>Results for ' .$searchTerm. '! </p> 
        <table>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Type</th>
                <th>Color</th>
                <th>Note</th>
            </tr>';

        while ($row =  mysqli_fetch_array($results, MYSQLI_ASSOC)){//mysqli_fetch_array($result)) {
            echo '
                <tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['date'].'</td>
                    <td>'.$row['type'].'</td>
                    <td>'.$row['color'].'</td>
                    <td>'.$row['Notes'].'</td>
                </tr>';
        }

        echo '
        </table>';
} else
echo "There was no matching record for the name " . $searchTerm  . ". Please check your spelling and try again.";
    
echo
    "</div>
    <div class='fright'>
    <!--Load the AJAX API-->
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
          var data = new google.visualization.DataTable(";
          
          echo json_encode($results);
          
          ");
          
          var options = {
              chart: {
                  title: 'Poos over time'
                  }, 
                  width = 900, 
                  height: 500, 
                  axes: {
                      x: {
                          0: {side:'top'}
                         }
                       }
                     };
            
            var chart = new google.charts.Line(document.getElementById('line_top_x'));
            chart.draw(data, options);
        }
    </script>";
      
echo
    "</div>
</div>";
?> 
