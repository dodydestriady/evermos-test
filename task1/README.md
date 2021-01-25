## Analisa 
Mengacu pada permasalahan tersebut terjadi saat penggunaan applikasi yang meningkat pada acara 12.12, dan pelaporan persediaan barang menjadi tidak akurat bahkan menyebabkan persediaan menjadi minus namun tidak ditemukan masalah kecepatan applikasi. Menurut pendapat saya kasus tersebut termasuk pada <i> race condition </i>, dimana banyak request yang diterima secara bersamaan pada suatu waktu. Untuk mengantisipasinya terdapat 2 teknik pengelolaan concurrency pada pada database yaitu optimistic dan pesimistic locking, jika pesimistic locking bekerja dengan mengunci table/data yang sedang digunakan maka saya menyarankan penggunaan optimistic, karena dengan traffic yang tinggi dikhawatirkan akan terjadi deadlock. 
untuk saran ke2 jika update applikasi belum terpenuhi yaitu secara manual tidak menampilkan barang dengan stock yang tidak dirasa akan cukup.


Persyaratan
- RDBMS: postgresql, mysql, dsb,
- php7+
- composer


Cara Instalasi

``` 
 git clone https://gitub.com/dodydestriady/evermos-test.git
 cd evermos-test/task1
 config database dengan mencopy env.example menjadi .env
 composer install
 php artisan migrate
 php artisan serve 
```

