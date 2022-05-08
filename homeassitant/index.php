<?php

include "connection/connection.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home Assistant Histroy From Database</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    </head>
    <body>
    
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center my-5">
                            <h1 class="display-5 fw-bolder text-white mb-2">DATABASE VIEW</h1>
                          
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Features section-->
        <section class="py-5 border-bottom" id="features">
            <div class="container px-5 my-5">
                <table id="ha" class="my-auto mt-5 text-center">
                    <thead>
                        <tr>
                            <th>Device Name</th>
                            <th>Device State</th>
                            <th>Turn On Time</th>
                            <th>Turn Off Time</th>
                            <th>Total Duration</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
 
 
//$sql = "SELECT `state_id`,`entity_id`, `state`,`last_changed`,`last_updated`
//FROM `states` group by `entity_id` DESC";

$sql = "SELECT `state_id`,`entity_id`, `state`,`last_changed`,`last_updated` FROM `states` where `entity_id` like '%smart_plug%' group by `entity_id` DESC";
 
 ;

//  $sql = "SELECT * FROM `states` ORDER BY `state_id` DESC";
 
 
 $result = mysqli_query($conn, $sql);
 
 while($row = mysqli_fetch_array($result))  
 {  

    $date1 = new DateTime($row["last_changed"]);
    $date2 = new DateTime($row["last_updated"]);
    
    $diff = $date2->diff($date1);
    
    // $hours = $diff->h;
    // $hours = $hours + ($diff->days*24);

   $explodestring= explode(".",$row["entity_id"]);

echo '<tr>

<td>'. $explodestring[1]  .'</td>
<td>'.$row["state"].'</td>
<td>'.$row["last_changed"].'</td>
<td>'.$row["last_updated"].'</td>
<td>'.   $diff->format("%h"). " hours".  $diff->format(" %i minutes ").'</td>

</tr>';

 }

 ?>
                      
                    </tbody>
                </table>
            </div>
        </section>

  
    
     
        <!-- <footer class="py-5 bg-dark">
            <div class="container px-5"><p class="m-0 text-center text-white">Copyright &copy; Home Assistant</p></div>
        </footer> -->
           <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
       
        <script>
            $(document).ready( function () {
            $('#ha').DataTable();
        } );
        </script>
    </body>
</html>
