# eLearning Desa Membangun

### System Requirements
 - Apache 2.0
   - mod_rewrite
 - PHP 5.6
   - PHP short-tag enabled
   - PHP PDO
   - PHP MYSQLI
   - PHP GD
   - Fileinfo extension
 - MySQL Server
 - Composer
 - NodeJS
 - NPM
 - Git 

### Fresh Install

 - Instalasi PHP dependencies dengan Composer
    <pre>
    $ composer install
    </pre>    
 - Instalasi asset dependencies (jQuery, Bootstrap, Font Awesome, and more...) dengan npm
    <pre>
    $ cd public
    $ npm install
    </pre>
 - Beberapa direktori harus diubah permission menjadi writable
    <pre>
    $ chmod -R 775 public/user/avatar public/portal-content public/kelas-content app/files
    </pre>
 - Setelah itu ubah group menjadi `apache` (untuk CentOS) atau `www-data` (untuk Ubuntu)
    <pre>
    $ chown :apache -R public/user/avatar public/portal-content public/kelas-content app/files
    </pre>
 - Konfigurasi environment dengan cara mengopy file `.env.example` menjadi `.env`
    <pre>
    $ cp .env.example .env
    </pre>
 - Ubah konfigurasi setiap modul punya database sendiri-sendiri
    <pre>
    $ nano .env
    </pre>
    Pastikan semua host, user, password, dan nama database sudah sesuai di konfigurasi .env
 - Membangun database
    - Database yang dibutuhkan
        <pre>
        elearning_user
        elearning_portal
        elearning_forum
        elearning_konsultasi
        elearning_faq
        elearning_kelas
        elearning_elibrary
        </pre>
    - Ubah phinx agar menjadi executable
        <pre>
        $ chmod +x phinx vendor/robmorgan/phinx/bin/phinx
        </pre>
    - User dan Data Daerah
        <pre>
        $ ./phinx migrate -c phinx_user.php
        $ ./phinx seed:run -c phinx_user.php
        </pre>
    - Portal
        <pre>
        $ ./phinx migrate -c phinx_portal.php
        $ ./phinx seed:run -c phinx_portal.php
        </pre>
    - Forum
        <pre>
        $ ./phinx migrate -c phinx_forum.php
        </pre>
    - FAQ
        <pre>
        $ ./phinx migrate -c phinx_faq.php
        </pre>

License
----

Apache
