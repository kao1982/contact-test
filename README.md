#　お問い合わせフォーム

## 開発環境

- **Framework:** Laravel 8.83.8
- **Database:** MySQL 8.0.26
- **Web Server:** Nginx 1.21.1
- **Tool:** phpMyAdmin (Port: 8080)
- **Container:** Docker / Docker Compose

---

## ローカル環境構築の手順

リポジトリをクローンした後、以下の手順を順番に実行して環境を構築してください。
https://github.com/kao1982/contact-test

### 1. 環境設定ファイルの準備

`src` ディレクトリ内にある `.env.example` をコピーして `.env` を作成します。

```bash
cp src/.env.example src/.env

.env 作成後、ファイルを開いてデータベースの設定を以下のように環境に合わせて書き換えてください。
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

2. Dockerコンテナのビルドと起動
コンテナを構築し、バックグラウンドで起動します。

Bash
docker-compose up -d --build

3. パッケージのインストール
PHPコンテナに入り、Composerパッケージをインストールします。

Bash
docker-compose exec php composer install

4. アプリケーションキーの生成
Laravelの暗号化キーを生成します。

Bash
docker-compose exec php php artisan key:generate

5. マイグレーションとシーディングの実行
データベースのテーブルを作成し、初期データ（テストデータ）を投入します。

Bash
docker-compose exec php php artisan migrate --seed


◆各種URL

- **お問い合わせフォーム入力ページ:** `http://localhost/

- **管理画面:** `http://localhost/admin

- **ユーザ登録:** `http://localhost/register

- **ログイン画面:** `http://localhost/login





◆テーブル設計（ER図）

![ER図](erd.png)

- `users` (管理者用テーブル)
- `categories` (お問い合わせ種類テーブル)
- `contacts` (お問い合わせ内容テーブル)

```
