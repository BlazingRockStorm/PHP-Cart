<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Demo Shopping Cart</h1>
        <?php
            $connect=mysqli_connect("localhost","gryphon","123456","cart")or die("Failed to connect to MySQL: " . mysqli_connect_error());
            $sql="select * from disc order by id";
            $query=mysqli_query($connect,$sql);
            if(mysqli_num_rows($query) > 0){
                while($row=mysqli_fetch_array($query)){
                    error_reporting("E_NOTICE");//turn off some annoying unecessary notice message
                    echo "<div class=pro>";
                    echo "<h3>$row[title]</h3>";
                    echo "Tac Gia: $row[author] - Gia: ".number_format($row[price])." VND<br />";
                    echo "<p align='right'><a href='addcart.php?item=$row[id]'>Mua Dia Nay</a></p>";
                    echo "</div>";
                }
            }
   
?>
    </body>
</html>
