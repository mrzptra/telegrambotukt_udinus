<?php
$botToken = 'BOT_TOKEN_ANDA';
$update = json_decode(file_get_contents('php://input'), true);

if (isset($update['message'])) {
    $message = $update['message'];

    if (isset($message['text'])) {
        $text = $message['text'];

        if (strpos($text, '/cekukt') === 0) {
            $chatId = $message['chat']['id'];
            $nim = trim(substr($text, 7));

            if (!empty($nim)) {
                $apiUrl = "https://riizeadev.tech/api_siadin.php?nim=$nim";
                $apiResponse = file_get_contents($apiUrl);
                $data = json_decode($apiResponse, true);

                if ($data['status'] == true) {
                    $nama = $data['data']['nama_mhs'];
                    $tagihan = $data['data']['total_tagihan_skrg'];
                    $statusp = $data['data']['statuspembayaran'];
                    $nimupper = strtoupper($nim);
                    $response = "🔢 $nimupper\n👤 $nama\n💰 $tagihan\n💳 $statusp";
                    $photoUrl = $data['data']['foto_mhs'];

                    if (!empty($photoUrl)) {
                        sendTelegramPhotoWithCaption($botToken, $chatId, $photoUrl, $response);
                    }
                } else {
                    $response = "nim  $nim tidak ditemukan.";
                    sendTelegramMessage($botToken, $chatId, $response);
                }
            }
        } else {
            $chatId = $message['chat']['id'];
            $response = "❌ Perintah tidak dikenali. Silakan gunakan perintah /cekukt [nim].";
            sendTelegramMessage($botToken, $chatId, $response);
        }
    }
}

function sendTelegramMessage($token, $chatId, $message) {
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function sendTelegramPhotoWithCaption($token, $chatId, $photoUrl, $caption) {
    $url = "https://api.telegram.org/bot$token/sendPhoto";
    $data = [
        'chat_id' => $chatId,
        'photo' => $photoUrl,
        'caption' => $caption,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}
?>
