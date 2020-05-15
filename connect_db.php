<?php

$Setup_Server = 'xxx.xxxx.xxxx.xxx';

$Setup_User = 'user_db';

$Setup_Pwd = 'password_db';

$Setup_Database = 'Day';

mysql_connect($Setup_Server,$Setup_User,$Setup_Pwd);

mysql_query('use $Setup_Database');

mysql_query('SET NAMES UTF8');

?>