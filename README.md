# Laravel 11 Docker Setup

このプロジェクトは、Laravel 11をDockerで構築するためのセットアップです。

## 構成

- **PHP 8.2** (FPM)
- **Nginx** (Webサーバー)
- **MySQL 8.0** (データベース)
- **Redis** (キャッシュ)

## セットアップ手順

### 1. 前提条件

- Docker
- Docker Compose

### 2. Laravel 11のインストール

```bash
# インストールスクリプトを実行
chmod +x install-laravel.sh
./install-laravel.sh
```

### 3. Dockerコンテナの起動

```bash
# コンテナをビルドして起動
docker-compose up -d --build
```

### 4. アプリケーションキーの生成

```bash
# Laravelアプリケーションキーを生成
docker-compose exec app php artisan key:generate
```

### 5. データベースマイグレーション

```bash
# マイグレーションを実行
docker-compose exec app php artisan migrate
```

## アクセス

- **Webアプリケーション**: http://localhost:8000
- **MySQL**: localhost:3306
- **Redis**: localhost:6379

## データベース接続情報

- **ホスト**: db
- **データベース**: laravel
- **ユーザー名**: laravel
- **パスワード**: secret
- **ルートパスワード**: root

## 便利なコマンド

```bash
# コンテナの停止
docker-compose down

# ログの確認
docker-compose logs -f

# 特定のサービスのログ
docker-compose logs -f app

# Composerコマンドの実行
docker-compose exec app composer install

# Artisanコマンドの実行
docker-compose exec app php artisan list

# コンテナ内でシェルを開く
docker-compose exec app bash
```

## ファイル構造

```
.
├── docker-compose.yml
├── docker/
│   ├── nginx/
│   │   └── conf.d/
│   │       └── app.conf
│   ├── php/
│   │   ├── Dockerfile
│   │   └── local.ini
│   └── mysql/
│       └── my.cnf
├── src/          # Laravelアプリケーション
├── install-laravel.sh
└── README.md
```

## 解決方法

### 1. Laravelプロジェクトを`src`ディレクトリに移動

#### 手順
1. ルート直下のLaravel関連ファイル・ディレクトリ（`app/`, `bootstrap/`, `config/`, `public/`, `resources/`, `routes/`, `storage/`, `vendor/`, `.env`, `artisan`など）を`src/`ディレクトリにまとめて移動します。

2. その後、再度コンテナを再起動します。

### 2. コマンド例（Windows Bash/MINGW64）

```bash
mkdir -p src
mv app bootstrap config database lang public resources routes storage tests vendor .env .env.example artisan composer.json composer.lock package.json phpunit.xml vite.config.js src/
```

（ファイルが存在しない場合はエラーが出ますが、無視してOKです）

### 3. 再度コンテナを再起動

```bash
docker-compose down
docker-compose up -d --build
```

### 4. ブラウザで再度 http://localhost:8000 を確認

**もし自動で移動したい場合は「自動で移動して」とご指示ください。手動でやる場合は上記コマンドを実行してください。**

ご不明点があればご質問ください！ 