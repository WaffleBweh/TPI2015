<?php
require_once '../includes/specific_funtions.php';

debug(hashPerso('SuperAdmin'));

if (filter_input(INPUT_POST, 'login')) {
    $pseudo = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');
    
    
    if ($pseudo && $pass && userConnect($pseudo, $pass)){
        echo "connect";
    }
}
debug($_SESSION);

?>

<form method="post" action="login_Test.php">
    <label>Pseudo:</label>
    <input name="username" type="text"/> 
    <input name="password" type="password"/>
    <input name="login" type="submit"/>

</form>