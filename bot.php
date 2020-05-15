<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '9pSezoXdlbdW3awkrAATHt+K9vttEmzpzimoA2Bt9T1kPChgfzmLkLrN/i8njZxOrmGeVzfrwb0OPrWR7QHLpU9opBYnJN4TVnx/ZQjYsUDhHYdaJ0DI0ZHU0sGbJ0zWNkJM1X2H/Ulv358M0DxRpAdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'b2c41aff00a24dd910f25f53208a6d18';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            //Debug Detail message
            'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  
           // 'messages' => [['type' => 'text', 'text' => $text ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);


        //Send Data Reply to User
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        //echo "Result: ".$send_result."\r\n";
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>