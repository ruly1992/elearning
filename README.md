# elearning

Untuk mendapatkan table profile dan master data daerah, lakukan perintah berikut.

<pre>composer update
./phinx migrate -c phinx_user.php
./phinx seed:run -c phinx_user.php
</pre>
