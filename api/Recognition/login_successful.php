<?php
session_start();
if(!session_is_registered(user)){
header("super_admin.php");
}
?>


<html>
<body>
Login Successful
</body>
</html>