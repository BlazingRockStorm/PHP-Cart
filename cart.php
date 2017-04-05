<?php
session_start();
if(isset($_POST['submit']))
{
 foreach($_POST['qty'] as $key=>$value)
 {
  if( ($value == 0) and (is_numeric($value)))
  {
   unset ($_SESSION['cart'][$key]);
  }
  elseif(($value > 0) and (is_numeric($value)))
  {
   $_SESSION['cart'][$key]=$value;
  }
 }
 header("location:cart.php");
}
?>
<html>
<head>
 <title>Demo Shopping Cart</title>
 <link rel="stylesheet" href="style.css" />
</head>
<body>
<h1>Demo Shopping Cart</h1>
<?php
$ok=1;
if(isset($_SESSION['cart'])){
 foreach($_SESSION['cart'] as $k => $v){
  if(isset($k)){
   $ok=2;
  }
 }
}
if($ok == 2){
   error_reporting("E_NOTICE");//turn off some annoying unecessary notice message 
   echo "<form action='cart.php' method='post'>";
   foreach($_SESSION['cart'] as $key=>$value){
    $item[]=$key;
   }
   $total=0;
   $str=implode(",",$item);
   $connect=mysqli_connect("localhost","gryphon","123456","cart")or die("Failed to connect to MySQL: " . mysqli_connect_error());
   $sql="select * from disc where id in ($str)";
   $query=mysqli_query($connect,$sql);
   while($row=mysqli_fetch_array($query)){
   echo "<div class='pro'>";
   echo "<h3>$row[title]</h3>";
   echo "Tac gia: $row[author] - Gia: ".number_format($row[price])." VND<br />";
   echo "<p align='right'>So Luong: <input type='text' name='qty[$row[id]]' size='5' value='{$_SESSION['cart'][$row[id]]}'> - ";
   echo "<a href='delcart.php?productid=$row[id]'>Xoa Dia Nay</a></p>";
   echo "<p align='right'> Gia tien cho mon hang: ". number_format($_SESSION['cart'][$row[id]]*$row[price]) ." VND</p>";
   echo "</div>";
   $total+=$_SESSION['cart'][$row[id]]*$row[price];
   }
  echo "<div class='pro' align='right'>";
  echo "<b>Tong tien cho cac mon hang: <font color='red'>". number_format($total)." VND</font></b>";
  echo "</div>";
  echo "<input type='submit' name='submit' value='Cap Nhat Gio Hang'>";
  echo "<div class='pro' align='center'>";
  echo "<b><a href='index.php'>Mua Dia Tiep</a> - <a href='delcart.php?productid=0'>Xoa Bo Gio Hang</a></b>";
  echo "</div>"; 
 }
else
 {
  echo "<div class='pro'>";
  echo "<p align='center'>Ban khong co mon hang nao trong gio hang<br /><a href='index.php'>Buy Dia</a></p>";
  echo "</div>";
 }
?>
</body>
</html>