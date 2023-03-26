
<?php
define('DB_SERVER','localhost');
define('DB_USER','id19474749_peo_cloud_db_user');
define('DB_PASS' ,'Y|bCM51X9\z{%RDu');
define('DB_NAME', 'id19474749_peo_cloud_db');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>