1. **Buka Aplikasi Telegram:**
   - Pastikan Anda memiliki aplikasi Telegram di ponsel Anda. Jika belum, unduh dan instal dari toko aplikasi yang sesuai (Google Play Store atau Apple App Store).

2. **Cari BotFather:**
   - Buka aplikasi Telegram dan cari "BotFather" dalam kotak pencarian.

3. **Mulai Obrolan dengan BotFather:**
   - Klik atau ketuk profil BotFather, dan kemudian klik tombol "Mulai" atau "Start" untuk memulai obrolan dengan BotFather.

4. **Buat Bot Baru:**
   - Dalam obrolan dengan BotFather, ketik perintah `/newbot` dan kirim.

5. **Beri Nama Bot:**
   - BotFather akan meminta Anda memberikan nama untuk bot Anda. Ketikkan nama yang Anda inginkan untuk bot Anda (misalnya, "MyCoolBot") dan kirim.

6. **Beri Username Bot:**
   - BotFather akan meminta Anda memberikan username untuk bot Anda. Ini harus berakhir dengan "bot" dan bersifat unik di seluruh Telegram. BotFather akan memberi tahu Anda jika username yang Anda pilih sudah digunakan atau tidak. Misalnya, Anda bisa menggunakan "@MyCoolBot" sebagai username.

7. **Dapatkan Token Bot Anda:**
   - Setelah Anda memberikan username, BotFather akan menghasilkan token untuk bot Anda. Token ini sangat penting dan digunakan untuk mengautentikasi bot Anda ke server Telegram. BotFather akan memberi tahu Anda token bot dengan pesan seperti ini:

   ```
   Congratulations! You've successfully created a bot. Here is your bot's token:
   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   Use this token to access the HTTP API:
   https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   ```

   - Simpan token ini dengan aman, karena Anda akan menggunakannya dalam pengembangan bot Anda.

8. **Bot Anda Telah Dibuat:**
   - Setelah Anda mendapatkan token, BotFather akan memberi tahu Anda bahwa bot Anda telah berhasil dibuat. Selamat, Anda sekarang memiliki bot Telegram yang baru!

9. Paste token anda pada mainWebhook.php
10. setwebhook domain anda misal, https://api.telegram.org/botTULIS_TOKEN_BOT_DISINI/setWebhook?url=https://domain.kamu/mainWebhook.php   
11. selesai