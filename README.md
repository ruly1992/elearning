# elearning

Pastikan database khusus untuk user sudah dibuat di mysql (cek di .env), kemudian lakukan perintah dibawah:

<pre>composer update
./phinx migrate -c phinx_user.php
./phinx seed:run -c phinx_user.php
</pre>

Untuk mendapatkan table profile dan master data daerah, lakukan perintah diatas.

Helper untuk menggunakan Modul Login:

<pre>login_url();
logout_url();</pre>

untuk cek sudah login atau belum:

<pre>if ($user = sentinel()->check()) {
    // sudah login
}</pre>

Untuk dokumentasi lengkap, bisa dilihat di Sentinel https://cartalyst.com/manual/sentinel/2.0#native


