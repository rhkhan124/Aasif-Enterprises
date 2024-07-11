
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$item =$_GET["item"];
$flat =$_GET["flat"];
$wing =$_GET["wing"];
$qty =$_GET["qty"];
$unit =$_GET["unit"];
$emp =$_GET["emp"];
$limit =$_GET["limit"];
$remark =$_GET["remark"];
$ext1 =$_GET["ext1"];


/// device info

$encId = $id;
$encUser = $user;
$encToken = $token;
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$dec_iv = '1234567891011121';
$dec_key = "9923377552";

//$BtokenC = openssl_encrypt($token_stringC, $ciphering, $encryption_key, $options, $encryption_iv);
$decId=openssl_decrypt ( $encId , $ciphering, $dec_key, $options, $dec_iv);
$decUser=openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv);
$decToken=openssl_decrypt ( $encToken , $ciphering, $dec_key, $options, $dec_iv);


date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");

$part = date('dmY');

$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$tokennumber =$project.$wing.$emp.$part;

$projectList ="";


/*$projectList = explode(","$projectArray);
for ($x = 0; $x <= count($projectList); $x++) {


}
*/


$req1 = "SELECT * FROM `AAuser` WHERE `id`='$decId' AND `password`='$decToken' and `Main`='$decUser'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) == 0)
{
echo 1;
}
else
{
$reqData = mysqli_fetch_assoc($reqR);
$role = $reqData["role"];
$active = $reqData["ext2"];
$type = $reqData["type"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="main")
{


$req1xa = "SELECT SUM(qty) as allstock FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
$reqRxa = mysqli_query($con, $req1xa);
$resutAa =mysqli_fetch_assoc($reqRxa);

$allstocka = $resutAa["allstock"];

$req1xda = "SELECT SUM(qty) as allissue FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
$reqRxda = mysqli_query($con, $req1xda);
$resultBa = mysqli_fetch_assoc($reqRxda);
$allissuea = $resultBa["allissue"];


$req1xdab = "SELECT SUM(qty) as allissueb FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$item' and `ext1`='$ext1'";
$reqRxdab = mysqli_query($con, $req1xdab);
$resultBab = mysqli_fetch_assoc($reqRxdab);
$allissueab = $resultBab["allissueb"];

$dataB = $allstocka-$allissuea;
if(($allissueab+$qty)>$limit)
{
echo "Over limit cant be issued";
}
else
{
if($qty>$dataB)
{
echo "Stock is low can not issue material";
 }
 else
 {

$req1x = "INSERT INTO `AAissue` (`item`, `qty`, `unit`, `project`, `wing`, `flat`, `emp`, `date`, `verified`, `token`, `remark`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$item', '$qty', '$unit', '$project', '$wing', '$flat', '$emp', '$date', 'Not Verified', '$tokennumber', '$remark', '$encUser', '$encId', '$ext1', '', '')";
$reqRx = mysqli_query($con, $req1x);

echo '<tr>
      <td style="text-align:center;">Employee</td>
      <td style="text-align:center;" >Qty</t>
      <td style="text-align:center;">Unit</td>
      <td style="text-align:center;" ></td>
      </tr>';

$req1b = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `ext1`='$ext1' GROUP BY item";
$reqRb = mysqli_query($con, $req1b);
while ( $resultb =mysqli_fetch_assoc($reqRb))
{
$zitem = $resultb["item"];
      $req3 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$zitem'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];
echo '<tr>
<td colspan="4" style="text-align:center;">'.$workname.'</td>
</tr>';
$req1bb = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$zitem' and `ext1`='$ext1'";
$reqRbb = mysqli_query($con, $req1bb);
while ( $resultbb =mysqli_fetch_assoc($reqRbb))
{
$zid = $resultbb["id"];
$zname = $resultbb["emp"];
$zqty = $resultbb["qty"];
$zunit = $resultbb["unit"];

      $req3m = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$zname'";
      $run3m = mysqli_query($con, $req3m);
      $result3m = mysqli_fetch_assoc($run3m);
      $worknamem = $result3m["name"];
      
      echo '<tr id="g'.$zid.'" style="height:30px;">
      <td >'.$worknamem.'</td>
      <td style="text-align:right;">'.$zqty.'</td>
      <td style="text-align:center;">'.$zunit.'</td>
      <td style="text-align:right;" ><button class="mybutton" onclick="cancelM('.$zid.');">cancel</button></td>
      </tr>';

}
}

}
}





















}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if(29==29)
{
$check =1;
}
}
if($check==1)
{


$req1xa = "SELECT SUM(qty) as allstock FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
$reqRxa = mysqli_query($con, $req1xa);
$resutAa =mysqli_fetch_assoc($reqRxa);

$allstocka = $resutAa["allstock"];

$req1xda = "SELECT SUM(qty) as allissue FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
$reqRxda = mysqli_query($con, $req1xda);
$resultBa = mysqli_fetch_assoc($reqRxda);
$allissuea = $resultBa["allissue"];


$req1xdab = "SELECT SUM(qty) as allissueb FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$item' and `ext1`='$ext1'";
$reqRxdab = mysqli_query($con, $req1xdab);
$resultBab = mysqli_fetch_assoc($reqRxdab);
$allissueab = $resultBab["allissueb"];

$dataB = $allstocka-$allissuea;
if(($allissueab+$qty)>$limit)
{
echo "Over limit cant be issued";
}
else
{
if($qty>$dataB)
{
echo "Stock is low can not issue material";
 }
 else
 {

$req1x = "INSERT INTO `AAissue` (`item`, `qty`, `unit`, `project`, `wing`, `flat`, `emp`, `date`, `verified`, `token`, `remark`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$item', '$qty', '$unit', '$project', '$wing', '$flat', '$emp', '$date', 'Not Verified', '$tokennumber', '$remark', '$encUser', '$encId', '$ext1', '', '')";
$reqRx = mysqli_query($con, $req1x);

echo '<tr>
      <td style="text-align:center;">Employee</td>
      <td style="text-align:center;" >Qty</t>
      <td style="text-align:center;">Unit</td>
      <td style="text-align:center;" ></td>
      </tr>';

$req1b = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `ext1`='$ext1' GROUP BY item";
$reqRb = mysqli_query($con, $req1b);
while ( $resultb =mysqli_fetch_assoc($reqRb))
{
$zitem = $resultb["item"];
      $req3 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$zitem'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];
echo '<tr>
<td colspan="4" style="text-align:center;">'.$workname.'</td>
</tr>';
$req1bb = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$zitem' and `ext1`='$ext1'";
$reqRbb = mysqli_query($con, $req1bb);
while ( $resultbb =mysqli_fetch_assoc($reqRbb))
{
$zid = $resultbb["id"];
$zname = $resultbb["emp"];
$zqty = $resultbb["qty"];
$zunit = $resultbb["unit"];
    
    if($role=="Employee")
    {
   $date3 = $resultbb["date"];
   $days = (strtotime($date) - strtotime($date3)) / (60 * 60 * 24);
   $display ="";
   $dis ="";
   
   if($days>1)
   {
   $display ="none";
   }
   else
   {
   $display ="block";
   }
}
else 
{
$date3 = $resultbb["date"];
   $days = (strtotime($date) - strtotime($date3)) / (60 * 60 * 24);
   $display ="";
   $dis ="";
   
   if($days>3)
   {
   $display ="none";
   }
   else
   {
   $display ="block";
   }
}
      $req3m = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$zname'";
      $run3m = mysqli_query($con, $req3m);
      $result3m = mysqli_fetch_assoc($run3m);
      $worknamem = $result3m["name"];
      
      echo '<tr id="g'.$zid.'" style="height:30px;">
      <td >'.$worknamem.'</td>
      <td style="text-align:right;">'.$zqty.'</td>
      <td style="text-align:center;">'.$zunit.'</td>
      <td style="text-align:right;" ><button class="mybutton" style="display:'.$display.';" onclick="cancelM('.$zid.');">cancel</button></td>
      </tr>';

}
}

}
}



























}
else
{
echo 2;
}
}
else
{
echo 3; //Temporary blocked
}
}
}

/// encryption


?>