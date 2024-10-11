<?php
/*
Magic Time Bio /AmirHajian
*/
try {
date_default_timezone_set('Asia/Tehran');
if (!file_exists('madeline.php')) {
 copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';
include 'lib/WideImage.php';
include ('jdf.php');
$fonts = [["Ѳ","１","❷","➂","４","５","６","７","８","❾"],["【0】","【1】","【2】","【3】","【4】","【5】","【6】","【7】","【8】","【9】"],["『0』","『1』","『2』","『3』","『4』","『5』","『6』","『7』","『8』","『9』"],["░0","░1","░2","░3","░4","░5","░6","░7","░8","░9"],["[̲̅0]","[̲̅1]","[̲̅2]","[̲̅3]","[̲̅4]","[̲̅5]","[̲̅6]","[̲̅7]","[̲̅8]","[̲̅9]"],["0","҉1","҉2","҉3","҉4","҉5","҉6","҉7","҉8","҉9҉"],["0","➀","➁","➂","➃","➄","➅","➆","➇","➈"],["0","❶","❷","❸","❹","❺","❻","❼","❽","❾"],["0","①","②","③","④","⑤","⑥","⑦","⑧","⑨"],["0","⑴","⑵","⑶","⑷","⑸","⑹","⑺","⑻","⑼"]];
$time2 = str_replace(range(0,9),$fonts[array_rand($fonts)],date("H:i"));
$day_number = jdate('j');
$month_number = jdate('n');
$year_number = jdate('y');
$day_name = jdate('l');
$settings = [];
$settings['logger']['logger'] = 0;
$settings = ['logger'=>['logger'=>0],'app_info'=> ['api_id'=>YOUR_APIID,'api_hash'=> 'YOUR_API_HASH']];
$MadelineProto = new \danog\MadelineProto\API('session.madeline',$settings);
$MadelineProto->start();
$me = $MadelineProto->get_self();
$me_id = $me['id'];
$img = $MadelineProto->photos->getUserPhotos(['user_id' => $me_id, 'offset' => 0, 'max_id' => 0, 'limit' => 1]);
$id_img = $img['photos']['0']['id'];
$hash_img = $img['photos']['0']['access_hash'];
$MadeLineproto_F = ['_' => 'inputPhoto', 'id' => $id_img, 'access_hash' => $hash_img];
$MadelineProto->photos->deletePhotos(['id' => [$MadeLineproto_F]]);
$time = date('H:i');
$bg = WideImage::load(rand(1,9).'.jpg');
$final = $bg ->resize(512, 512);
$canvas = $final ->getCanvas();
$canvas->useFont('./f.ttf', 26, $final->allocateColor(255, 255, 255));
$canvas->writeText('center', 'center', "
[ $time ]");
$final->saveToFile('time.jpg');
$MadelineProto->photos->uploadProfilePhoto(['file' => 'time.jpg']);
$MadelineProto->sleep(1);
$MadelineProto->account->updateProfile(['about' => "$time2 امروز $day_name  •|•  $year_number/$month_number/$day_number "]);
$MadelineProto->account->updateProfile(['last_name' => "$time2"]);
echo 'MagicSudo Time Bio OK!';
} catch(Exception $e) {
    echo $e;
}
/*
Magic Time Bio /AmirHajian
*/