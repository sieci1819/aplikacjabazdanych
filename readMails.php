<?php


$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'APLIKACJEBAZDANYCHNODE@gmail.com';
$password = 'banDersnatch1410';
$runTime = 600000;

set_time_limit($runTime);

$users = Array();
/* try to connect */
	require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);
WaitForEmails($hostname,$username,$password);


function WaitForEmails($hostname,$username,$password){
		
	$t1=time();//mark time in
	$tt=$t1+(60*1);//total time = t1 + n seconds
	$imap = imap_open($hostname,$username,$password);

	do{
		if(isset($t2)) unset($t2);
		$t2=time();
		if(imap_num_msg($imap)!=0){

			$mc=imap_check($imap);
			CheckForNewEmails($imap);
		}

		sleep(rand(7,13));
		if(!@imap_ping($imap)){
			$imap = imap_open($hostname,$username,$password);
		}

	}while($tt>$t2);
}

function CheckForNewEmails($imap){
	$count = imap_num_msg($imap);
	global $connection;
	global $username;
	for($msgno = 1; $msgno <= $count; $msgno++) {
		$headers = imap_headerinfo($imap, $msgno);
		if($headers->Unseen == 'U') {

			$message=  imap_fetchbody($imap,$msgno, 1);
			$message=simplexml_load_string($message);
			if((string)$message->type == 'login'){
				$cipherKey = TryToAuthenticate((string)$message->login,(string)$message->password);
				global $users;
				$users[$cipherKey] = (string)$message->login;
				SendMail(CreateLoginResponse((string)$message->id,$cipherKey)->asXML());
				
				imap_delete ( $imap,$msgno );
			}else if ((string)$message->type == 'query'){
				$response = "";
				if(CheckAuthentication((string)$message->cipherKey)){
					$sql = "SELECT $message->where FROM tabela";
					if($message->where !=""){
						$sql .= " WHERE ".$message->where;
					}
					if($result = @$connection->query($sql))
					{
						$response = CreateQueryResult($message->id,$result);
					}
					else
						$response = CreateQueryError($message->id);
				}else{
					$response = CreateQueryError($message->id);
					
				}
				SendMail($response->asXML());
				imap_delete ( $imap,$msgno );
			}
		}
	   
	}
}

function CheckAuthentication($cipherKey){
	global $users;
	global $connection;
	$username = $users[$cipherKey];
	$sql = "SELECT * FROM USERS WHERE USERNAME='$username' AND SECRETKEY='$cipherKey'";
	if($result = @$connection->query($sql))
	{
		$numberOfRows = $result->num_rows;
		if($numberOfRows>0)
			return true;
		else
			return false;
	}
	else 
		return false;
}

function CreateQueryResult($id, $result){
	$output = new SimpleXMLElement("<email></email>");
	$output->addChild('type','queryResult');
	$output->addChild('id',$id);
	$output->addChild('result',json_encode($result));
	return $output;
}
function CreateQueryError($id){
	$output = new SimpleXMLElement("<email></email>");
	$output->addChild('type','queryResult');
	$output->addChild('id',$id);
	$output->addChild('cipherKey',$cipherKey);
	$output->addChild('error','ERR');
	return $output;
}

function CreateLoginResponse($id, $cipherKey){
	$output = new SimpleXMLElement("<email></email>");
	$output->addChild('type','loginResponse');
	$output->addChild('id',$id);
	$output->addChild('cipherKey',$cipherKey);
	$output->addChild('authResult',$cipherKey == null ? "ERR":"OK");
	return $output;
}

function TryToAuthenticate($login, $password){
	
	global $connection;
	$sql = "SELECT * FROM USERS WHERE USERNAME='$login' AND PASS='$password'";
	//$result = @$connection->query($sql);
	if($result = @$connection->query($sql))
	{
		$numberOfUsers = $result->num_rows;
		if($numberOfUsers>0)
		{
			$cipherKey = GenerateCipherKey();
			$sql = "UPDATE USERS SET SECRETKEY = '".$cipherKey."' WHERE USERNAME='".$login."'";
			$result->free_result();
			$result = @$connection->query($sql);
			
			return $cipherKey;
		}	else {
			
		}
	}
}

function GenerateCipherKey(){
	return 42;
}

function SendMail($body){
	require_once "Mail.php";
	global $username;
	global $password;
	

	$from = '<'.$username.'>';
	$to = '<'.$username.'>';

	$headers = array(
		'From' => $from,
		'To' => $to,
		'Subject' => ""
	);

	$smtp = Mail::factory('smtp', array(
			'host' => 'ssl://smtp.gmail.com',
			'port' => '465',
			'auth' => true,
			'username' => $username,
			'password' => $password
		));

	$mail = $smtp->send($to, $headers, $body);

}


?>