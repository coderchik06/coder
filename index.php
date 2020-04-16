<?php
define('API_KEY','1297794420:AAGqPUEDc0rkogT36ocpaYdI4MDCQKYdOkE');
$admin = "621617473";

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$name = $message->chat->first_name;
$user1 = $message->from->username;
$tx = $message->text;
$msg = $message->text;
$step = file_get_contents("step/$cid.step");
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$uid= $message->from->id;
$name = $message->from->first_name;
$newid = $message->new_chat_member->id;
$username = $message->from->username;
$newname = $message->new_chat_member->first_name;
$data = $update->callback_query->data;
$cid2 = $update->callback_query->message->chat->id; 
$cqid = $update->callback_query->id;
$chat_id2 = $update->callback_query->message->chat->id;
$ch_user2 = $update->callback_query->message->chat->username;
$message_id2 = $update->callback_query->message->message_id;
$fadmin = $message->from->id;

$name2 = $update->callback_query->from->first_name;
$step = file_get_contents("$cid.step");

mkdir("data");
mkdir("data/$cid");


$lichka = file_get_contents("CoDeR.ids");
if($type=="private"){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("CoDeR.ids","$lichka\n$cid");
}
} 

@$command = file_get_contents("data/$cid/command.txt");


$keys = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"👫Sevishganlar👫"]],
[['text'=>"🌅Bollar uchun👨‍💼"],['text'=>"🌅Qizlar uchun👩‍💼"],],
[['text'=>"💫 Ortga qaytish"],],
]
]);

$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🌅Rasm tayyorlash🖌"],['text'=>"Statistika📊"],],
[['text'=>"🤖Bot zakas qilish"],],
]
]);





$vaqt = date("d",strtotime("5 hour"));
$otex = "💫 Ortga qaytish";

$otmen = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$otex"],],
]
]);

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📤Send oddiy"],['text'=>"📤Send Forward"],],
[['text'=>"💫 Ortga qaytish"],['text'=>"Bekor qilish⛔"]],
]
]);

if ($text == "/admin" and $cid == $admin){
bot ('SendMessage', [
'chat_id'=> $cid,
'text'=>"👨‍💻Admin paneli:",
'reply_to_message_id'=> $mid,
'reply_markup'=> $panel,
]);
}

if($text=="/start"){
	if(joinchat($uid)=="true"){
bot('sendphoto',[
'photo'=>"https://t.me/hacker_progi/53643",
    'chat_id'=>$cid,
    'caption'=>"⌚ *Salom* [$name](tg://user?id=$cid)  🤖: *Men orqali ismingiz ajoyib rasmga joylashingiz mumkin

Buning uchun pastdagi bolimlarni birini tanlang*👇",
    'parse_mode'=>'markdown',
    'reply_markup'=>$key,
    ]);
}
}

if($text== $otex){
unlink("data/$cid/command.txt");
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"⤵ Bosh menuga qaytingiz!",
'reply_markup'=>$key,
]);
}
if($text == "🌅Rasm tayyorlash🖌"){
if(joinchat($uid)=="true"){
bot('sendmessage', [
'chat_id' => $cid,
'text'=>"*Ismingizni  rasmga tushirish uchun kerakli bolimni tanlang*",
'message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keys,
]);
}
}
if($text == "Statistika📊"){
if(joinchat($uid)=="true"){
$vaq = date("⏰H:i  📅d_m_Y",strtotime("2 hour"));
$baza = file_get_contents("CoDeR.ids");
$us = substr_count($baza,"\n"); 
     bot('sendMessage',[
     'chat_id'=>$cid,
     'text'=>"*🔹Botimiz Azolari👥: * [$us] *ta!*\n 🔹 [$vaq]",
     'parse_mode'=>'markdown',
     ]);
     }} 

if($text == "👫Sevishganlar👫"){
if(joinchat($uid)=="true"){
file_put_contents("data/$cid/command.txt","ramazon");
bot('sendmessage', [
'chat_id' => $cid,
'text'=>"Ismingizni  yuboring",
'message_id'=>$mid,
'parse_mode'=>'html',
'reply_markup'=>$otmen,
]);
}
}
if($command == 'ramazon'){
if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"Code96.zadc.ru/z/sev.php?text=$text",
'caption'=>"📋Buyurtma: *$text*

[@Multikismrobot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keys,
]);
file_put_contents("data/$cid/command.txt","none");
unlink("data/$cid/command.txt");
unlink("data/goto.jpg");
}
}

if($text == "🌅Bollar uchun👨‍💼"){
if(joinchat($uid)=="true"){
file_put_contents("data/$cid/command.txt","makka");
bot('sendmessage', [
'chat_id' => $cid,
'text'=>"Ismingizni  yuboring",
'message_id'=>$mid,
'parse_mode'=>'html',
'reply_markup'=>$otmen,
]);
}
}
if($command == 'makka'){
if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"Code96.zadc.ru/z/bola.php?text=$text",
'caption'=>"📋Buyurtma: *$text*

[@Multikismrobot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keys,
]);
file_put_contents("data/$cid/command.txt","none");
unlink("data/$cid/command.txt");
unlink("data/goto1.jpg");
}
}
if($text == "🌅Qizlar uchun👩‍💼"){
if(joinchat($uid)=="true"){
file_put_contents("data/$cid/command.txt","corona");
bot('sendmessage', [
'chat_id' => $cid,
'text'=>"Ismingizni  yuboring",
'message_id'=>$mid,
'parse_mode'=>'html',
'reply_markup'=>$otmen,
]);
}
}
if($command == 'corona'){
if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"Code96.zadc.ru/z/qiz.php?text=$text",
'caption'=>"📋Buyurtma: *$text*

[@Multikismrobot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keys,
]);
file_put_contents("data/$cid/command.txt","none");
unlink("data/$cid/command.txt");
unlink("data/goto2.jpg");
}
}
   
   


if($text == "Bekor qilish⛔"&&$cid==$admin){
      bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Xabar yuborish Bekor qilindi!",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
      unlink("send.ok");
      unlink("send.no");
      }
    
    if ($text == "📤Send oddiy" and $cid == $admin ){
        file_put_contents("$cid.step", "send");
        bot('sendmessage', [
            'chat_id' => $cid,
            'text' => "Xabaringizni yuboring",
            'reply_to_message_id'=>$mid,
            'reply_markup'=>$panel
        ]);
    } 
if ($step== "send") {
        file_put_contents("$cid.step", "no");
        $fp = fopen("CoDeR.ids", 'r');
        while (!feof($fp)) {
            $ckar = fgets($fp);
            bot('sendMessage', [
'chat_id'=>$ckar,
'text'=>$text,
]);
        }
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Xabar muofaqiyatli yuborildi",
            'reply_to_message_id'=>$mid,
            'reply_markup' => $panel
        ]);
        unlink("$cid.step");
    } 
if ($text == "📤Send Forward" and $cid == $admin){
        file_put_contents("$cid.step", "fwd");
        bot('sendmessage', [
            'chat_id' => $cid,
            'text' => "Xabaringizni yuboring",
            'reply_to_message_id'=>$mid,
            'reply_markup'=>$key
        ]);
    } 
if ($step == 'fwd') {
        file_put_contents("$cid.step", "no");
        $forp = fopen("CoDeR.ids", 'r');
        while (!feof($forp)) {
            $fakar = fgets($forp);
            bot('forwardMessage', [
'chat_id'=>$fakar,
'from_chat_id'=>$cid,
'message_id'=>$mid,
]);
        }
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Xabar yuborildi",
            'reply_to_message_id'=>$mid,
            'reply_markup' => $key
        ]);
        unlink("$cid.step");
    } 


if($text == '/code' and $cid == $admin){
bot('sendDocument',[
'chat_id'=>$cid,
'document'=>new CURLFile(__FILE__),
'caption'=>" <b>code</b>",
'parse_mode'=>"html",
'reply_to_message_id'=>$mid,
]);
}




if($text == "🤖Bot zakas qilish"){
if(joinchat($uid)=="true"){
bot('sendmessage', [
'chat_id' => $cid,
'text'=>"*📲 Har qanday turdagi botlarni yaratib beramiz narxlar kelishilgan holda. Bot siz istagan usulda yaratib beriladi.⚙️

💸 Botlar 30 000 so'mdan boshlab yasaladi va botni darajasiga qarab narxlar oshib boradi.

💳 To'lovlar kelishilgan holda amalga oshiriladi. Agar bot yasattirish niyat bo'lsa quyidagi manzilga murojat qiling!*",
'message_id'=>$mid,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
  'reply_markup'=>json_encode([   
   'inline_keyboard'=>[   
            [['text'=>"🤖Zakas qilish",'url'=>"https://telegram.me/coder_chik"]],
]
]),
]);

}
}



?>
