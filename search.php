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
    <p>image will go here.</p>
    </div>
</div>";
?> 
