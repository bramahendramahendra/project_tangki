# project_tangki
Cara install

1. Buat DB baru dengan nama bebas . example : "me_volumecontroltank"
2. Jalankan query pada file me_volumecontroltank.sql pada DB yang talah anda buat.
3. Jalankan query pada file user_roles.sql pada DB yang talah anda buat.
4. BUka APP/Application/config/database :

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'me_volumecontroltank', // isi sesua DB yang anda buat === Ubah bagian ini sesuai DB yang anda buat
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

5. Done.
