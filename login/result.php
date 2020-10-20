<?php
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	
	$init = curl_init();
	$email = $_POST['email'];
	$UserToken='c1HIm12-TAykBKSUMHqsvj%3AAPA91bER8ssWinQkUi7r0bmtW0TtKawW8uzxWrzmBXtbaeRy0ixu0RnJ7G_sVu3CrRHK9EPsFebhGZ84Zikdd5mFO_OMTH7mGM3R-8JYtryLgOOJkKDfwBYAUsveNiZy_I3arrbYWt-n';
	$Password = $_POST['pwd'];

	curl_setopt($init, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($init, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($init, CURLOPT_POST, 1);
	curl_setopt($init,  CURLOPT_URL, "https://fisms.com/api/EmailLogIn?&Email=$email&UserToken=$UserToken&Device=Android&Password=$Password");

	#----------------------------------------------------------------------------	

	$result = curl_exec($init);
		curl_exec($init);
		
        $keys=[];
        $values=[];
		$result = str_replace(array("{","}","\"","'"), "", $result);
        $result = explode(",", $result);
#------------------------------------------------------------------------------------
	foreach ($result as  $value) {
        $value = explode(":",$value,2);
        array_push($keys,$value[0]);
        array_push($values,$value[1]);
    }
    $newArray = array_combine($keys,$values);
    if($newArray["Response"] == "GOON"){
        echo "<h2 style='text-align:center'> Your ID is ".$newArray["WinnerID"]."</h2>";
        echo "<h2 style='text-align:center'> Your Hash is ".$newArray["Hash"]."</h2>";
        header('Refresh: 6;URL=../team');
    } else{
        echo "<h2 style='text-align:center'> Sorry Your Email Or Password Is Incorrect Please Try Again</h2>";
    }
	} else{
        echo "<h2 style='text-align:center'>You Can't Enter This Site Directly";
    }
?>