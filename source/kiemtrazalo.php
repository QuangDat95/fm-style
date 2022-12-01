<?php





$data_chat_unrep = get_chatlist_unreply();
$data_chat = json_decode($data_chat_unrep, true);



for ($i=0; $i < count($data_chat); $i++) { 
    $id_zalo = $data_chat[$i]['user_id'];
    $message = $data_chat[$i]['message'];
    $msg_id = $data_chat[$i]['msg_id'];
    $event_name = $data_chat[$i]['event_name'];
    $create_date = $data_chat[$i]['create_date'];
    $user_display_name = $data_chat[$i]['user_display_name'];
    $user_avatar = $data_chat[$i]['user_avatar'];
    $user_gender = $data_chat[$i]['user_gender'];
    $phone_number = $data_chat[$i]['tel'];
    $active = $data_chat[$i]['active'];

    $template->assign("id_zalo",$id_zalo);
    $template->assign("message",$message);
    $template->assign("msg_id",$msg_id);
    $template->assign("create_date",$create_date);
    $template->assign("user_display_name",$user_display_name);
    $template->assign("user_avatar",$user_avatar);
    $template->assign("user_gender",$user_gender);
    $template->assign("phone_number",$phone_number);
    $template->assign("active",$active);

    $template->parse("main.block_message_unreply");
}


function get_chatlist_unreply()
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://webhook.trungvu.vn/webhook/msg_unreply.php?type=chatlist_unseen',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Author: 146f06c0298a45cc0a65d7547085d94e6e35ba64df6757aa4ee52620c2fba080'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
} 

function get_chatlist_recent($user_id) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://openapi.zalo.me/v2.0/oa/conversation?data={"user_id":'.$user_id.',"offset":0,"count":10',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'access_token: RgLZKu4CpYbeeM9MWWh8A6oWP5Y14gvX5RXpGQvegMikWMH0nqI8JtgNGsBGGOb4RvbvO-zprXzHkXm-otdBFtAJ6Y-RVEWJSjWnAU4TdrHcy6ihrpZ53KZc4XReIjblGRaA4FD4_Wf2db8PrMwSFJwRRXkVHQPW4-Xr4Qm3gJKZvt4TbKo6B7ItBmZTOOSWIujf8jzui1ypqniWgGl06ptQ3sJT1FTORwqX8CPLy5fkfWDmuWojINBtVKFU8x1hFibZGQrjbqmbc4nqkcQHTrMhV4wvJgnb0B5gPfrWecmcjdDMQTYSdac55ymg'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}
