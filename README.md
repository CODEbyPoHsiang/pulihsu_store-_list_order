<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Laravel AJAX CRUD 7.x
======================

_Laravel AJAX CRUD Modal_ demo provides basic CRUD web application without page refresh in Laravel using Bootstrap Modal and AJAX.


## 還原步驟
1. CLONE 專案 :
```js
   git clone https://github.com/CODEbyPoHsiang/Laravel7CRUD-AJAX
```
2. cd 進入專案資料夾
```
  cd Laravel7CRUD-AJAX
```
3. 更換env檔 
```
cp .env.example .env
```
4. 安裝 composer 
```
  composer install
```
5. 到 phpmyadmin 建立 database(只需一次)
```
DB 名稱:ajax
DB 編碼:utf8mb4_unicode_ci
```
6. An application key can be generated
```
  php artisan key:generate
```
7. migrate 自動生成資料表
```
  php artisan migrate
```
8. 啟動 artisan serve  服務
```
  php artisan serve
```

9.假資料生成(已經預先做好Faker及Seeder設定，只需輸入指令即可)
```
  php artisan db:seed --class=MemberTableSeeder
```
10. 啟動 php artisan 服務
```
  php artisan serve
```
11. 開啟網頁連結
```
  http://localhost:8000
```
---
## Laravel 主要資料夾說明:

* app/Http/Controllers/MemberController.php => 增刪修查功能皆在這裏面(控制器)<br/>
* app/Member.php => 跟資料表有關，控制器或假資料生成都需要使用 use App\Member來做引用<br/>
* database/factories/MemberFactory.php => 定義假資料生成的欄位屬性<br/>
(此指令已經在專案裡生成，不必在執行一次)<br/>
```
    php artisan make:factory MemberFactory
```
<br/>

* database/seeds/MemberTableSeeder.php => 生成假資料連接資料庫並寫入的設定<br/>
(此指令還原專案後，需要執行，才可以生成假資料，可自訂生成數，指令每操作一次會重置一次資料)<br/>
```
    php artisan db:seed --class=MemberTableSeeder
```
<br/>

* resources/view/index.blade.php => 前台顯示的介面可以利用這個blade語法生成<br/>
* routes/web.php => 主要負責網頁進來的路由控制<br/>
* public/js/ajaxscript.js => 在blade內使用到的ajax的jQUERY程式碼<br/>

---
## Laravel 主要API說明:
* API路由控制路徑 : routes/api.php => 主要負責網頁進來的路由控制<br/>
* 利用 POSTMAN 來測試 API<br/>
---
* 顯示全部資料 API (GET)
```
http://localhost:8000/api
```
* 查看單一資料 API (GET)
```
http://localhost:8000/api/{id}
```
* 新增一筆資料 API (POST)
```
http://localhost:8000/api/new
```
* 編輯一筆資料 API (PUT)
```
http://localhost:8000/api/edit/{id}
```
* 刪除一筆資料 API (DELETE)
```
http://localhost:8000/api/delete/{id}
```
---

