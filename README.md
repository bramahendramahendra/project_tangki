# project_tangki
Cara install

1. Buat DB baru dengan nama bebas . example : "me_volumecontroltank"
2. Jalankan query pada file me_volumecontroltank.sql pada DB yang talah anda buat.
3. Jalankan query pada file user_roles.sql pada DB yang talah anda buat.
4. BUka APP/Application/config/database :

$db['default'] = array(
	'database' => 'me_volumecontroltank', // isi sesua DB yang anda buat === Ubah bagian ini sesuai DB yang anda buat
);

5. Done.
