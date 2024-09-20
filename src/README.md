お問い合わせフォーム

環境構築

Dockerビルド
1.git clone git@github.com:coachtech-material/laravel-docker-template.git
2.mv laravel-docker-template contact-form-test
3.cd contact-form
4.git remote set-url origin git@github.com:kobasikibo/contact-form-test.git
5.git remote -v
6.git add .
7.git commit -m "リモートリポジトリの変更"
8.git push origin main
9.docker-compose up -d --build
10.code .


Laravel環境構築

1.docker-compose exec php bash
2.composer install
3.cd .env.example .env
4.php artisan key:generate
5.Eloquentモデルの確認、作成、編集。
6.ER図の考察、作成。
7.php artisan make:migration
8.シーダーの作成。
9.使用環境の確認。
10.データベースの接続情報の再確認。
11.php artisan serve
12.php artisan migrate
13.データベースのテーブル確認。
14.database/seedersにシーダーの作成、ダミーデータの定義。
15.php artisan db:seed
16.データの確認。


使用技術
・PHP 7.4.9
・Laravel Framework 8.83.27
・mysql:9.0.1


ER図

・src/database/diagrams/my_er_diagram.draw


URL

・開発環境：http://localhost/
・phpMyAdmin：http://localhost:8080/