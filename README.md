# eLearning Desa Membangun

### System Requirements
 - PHP >= 5.6
 - MySQL Server
 - PHP short-tag enabled
 - Composer
 - NodeJS
 - NPM
 - Git 

### Fresh Install

 - Instalasi PHP dependencies dengan Composer
    ```
    $ composer install
    ```
 - Instalasi asset dependencies (jQuery, Bootstrap, Font Awesome, and more...) dengan npm
    ```
    $ cd public
    $ npm install
    ```
 - Beberapa direktori harus diubah permission menjadi writable
    ```
    $ chmod 775 -R public/user/avatar public/portal-content public/kelas-content app/files
    ```
 - Setelah itu ubah group menjadi `apache` (untuk CentOS) atau `www-data` (untuk Ubuntu)
    ```
    $ chown :apache -R public/user/avatar public/portal-content public/kelas-content app/files
    ```
 - Konfigurasi environment dengan cara mengopy file `.env.example` menjadi `.env`
    ```
    $ cp .env.example .env
    ```
 - Ubah konfigurasi setiap modul punya database sendiri-sendiri
    ```
    $ nano .env
    ```
    > Pastikan semua host, user, password, dan nama database sudah sesuai di konfigurasi .env
 - Membangun database
    - Ubah phinx agar menjadi executable
        ```
        $ chmod +x phinx vendor/robmorgan/phinx/bin/phinx
        ```
    - User dan Data Daerah
        ```
        $ ./phinx migrate -c phinx_user.php
        $ ./phinx seed:run -c phinx_user.php
        ```
    - Portal
        ```
        $ ./phinx migrate -c phinx_portal.php
        $ ./phinx seed:run -c phinx_portal.php
        ```

License
----

Apache
