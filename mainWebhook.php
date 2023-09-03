<?php

// Ganti dengan token bot Telegram Anda
$botToken = 'BOT_TOKEN_ANDA'; // gANTI DISINI

// Mendapatkan data yang dikirim oleh Telegram
$update = json_decode(file_get_contents('php://input'), true);

// Memeriksa apakah data yang diterima adalah pesan
if (isset($update['message'])) {
    $message = $update['message'];
    
    // Memeriksa apakah pesan adalah perintah
    if (isset($message['text'])) {
        $text = $message['text'];
        
        // Memeriksa apakah pesan adalah perintah /cekukt
        if (strpos($text, '/cekukt') === 0) {
            // Menanggapi perintah /cekukt
            $chatId = $message['chat']['id'];
            
            // Mendapatkan nim dari pesan pengguna
            $nim = trim(substr($text, 7)); // Mengambil teks setelah /cekukt
            
            if (!empty($nim)) {
                // Mengirim permintaan ke API dengan NIM
                $apiUrl = "https://riizeadev.tech/api_siadin.php?nim=$nim";
                $apiResponse = file_get_contents($apiUrl);
                $data = json_decode($apiResponse, true);
                
                if ($data['status'] == true) {
                    // Menampilkan nama dari data mahasiswa
                    $nama = $data['data']['nama_mhs'];
                    $tagihan = $data['data']['total_tagihan_skrg'];
                    $statusp = $data['data']['statuspembayaran'];
                    $nimupper = strtoupper($nim);
                    // Membuat pesan dengan ikon yang sesuai
                    $response = "🔢 $nimupper\n👤 $nama\n💰 $tagihan\n💳 $statusp";
                    
                    // Mengambil URL foto
                    $photoUrl = $data['data']['foto_mhs'];

                    if (!empty($photoUrl)) {
                        // Mengirim foto bersama dengan teks
                        sendTelegramPhotoWithCaption($botToken, $chatId, $photoUrl, $response);
                    }
                }else{
                    $response = "nim  $nim tidak ditemukan.";
                    sendTelegramMessage($botToken, $chatId, $response);
                } 
            } 
            // Tidak perlu lagi mengirim pesan teks di sini
        } else {
            // Menanggapi perintah tidak dikenali
            $chatId = $message['chat']['id'];
            $response = "❌ Perintah tidak dikenali. Silakan gunakan perintah /cekukt [nim].";
            
            // Mengirim pesan balasan ke pengguna
            sendTelegramMessage($botToken, $chatId, $response);
        }
    }
}

// Fungsi untuk mengirim pesan teks ke Telegram
function sendTelegramMessage($token, $chatId, $message) {
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];
    
    // Mengirim permintaan HTTP POST
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Mengembalikan respons dari API Telegram
    return $response;
}

// Fungsi untuk mengirim foto bersama dengan teks ke Telegram
function sendTelegramPhotoWithCaption($token, $chatId, $photoUrl, $caption) {
    $url = "https://api.telegram.org/bot$token/sendPhoto";
    $data = [
        'chat_id' => $chatId,
        'photo' => $photoUrl,
        'caption' => $caption,
    ];
    
    // Mengirim permintaan HTTP POST
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Mengembalikan respons dari API Telegram
    return $response;
}
?>
