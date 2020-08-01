<?php
error_reporting(0);
require 'connect.php';

if (isset($_GET['shopID'])) {
    $shop = $_GET['shopID'];
} 
else {
    die('Error, shop not found');
}
   
$records = array();

if($results = $db->query("SELECT * FROM items WHERE shop_ID = '$shop'")) {
    //echo '<pre>', print_r($results), '</pre>';
    if($results->num_rows) {
        while($row = $results->fetch_object()) {
            $records[] = $row;
        }
        $results->free();
    }
}
//echo '<pre>', print_r($records),'</pre>';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Menu</title>
        <style>
        table {
            border-collapse: collapse;
            font-size: large;
            padding-right:200px; 
            }
               
        table, td, th {
            border: 1px solid black;
            }
            
        </style>
        
    </head>
    <body>
        <h3>Today's options</h3>
        <?php
        if(!count(records)) {
            echo 'Nothing today';
        } else {
        ?>
        
            <table style="width: 90%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Vegetarian</th>
                        <th>Vegan</th>
                        <th>Allergens</th>
                        <th>Energy kJ (Cal) </th>
                        <th>Carboydrates (g)</th>
                        <th>Fat (g)</th>
                        <th>Protein (g)</th>
                    <tr>
                </thead>
                </tbody>
                    <?php
                    foreach($records as $r) {
                    ?>
                        <tr style="text-align: center">
                            <td><?php echo $r->name; ?></td>
                            <td><?php echo $r->price; ?></td>
                            <td><?php 
                                    if($r->vegetarian == 1){
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    }; ?></td>
                            <td><?php 
                                    if($r->vegan == 1){
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    }; ?></td>
                            <td><?php echo $r->allergens; ?></td>
                            <td><?php echo $r->calories; ?></td>
                            <td><?php echo $r->carbs; ?></td>
                            <td><?php echo $r->fat; ?></td>
                            <td><?php echo $r->protein; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            }
            ?>

                    
    </body>
</html>

