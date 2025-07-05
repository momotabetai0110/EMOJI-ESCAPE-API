# Laravel 12 Docker Environment

Laravel 12、MySQL、phpMyAdminを含むDocker環境です。

## 構成

- **Laravel 12**: PHP 8.2 + Laravel 12
- **MySQL 8.0**: データベース
- **phpMyAdmin**: データベース管理ツール

## セットアップ手順

### 1. Laravelプロジェクトの作成

Windows環境の場合:
```bash
setup-laravel.bat
```

Linux/Mac環境の場合:
```bash
chmod +x setup-laravel.sh
./setup-laravel.sh
```

### 2. Dockerコンテナの起動

```bash
docker-compose up -d
```

### 3. アプリケーションキーの生成

```bash
docker-compose exec app php artisan key:generate
```

### 4. データベースマイグレーション

```bash
docker-compose exec app php artisan migrate
```

## アクセス方法

- **Laravel API**: http://localhost:8000
- **phpMyAdmin**: http://localhost:8080
  - ユーザー名: `root`
  - パスワード: `root`

## データベース設定

- **ホスト**: `db`
- **データベース名**: `laravel`
- **ユーザー名**: `laravel`
- **パスワード**: `password`

## 便利なコマンド

### コンテナ内でコマンド実行
```bash
docker-compose exec app php artisan [command]
```

### コンテナの停止
```bash
docker-compose down
```

### コンテナの再起動
```bash
docker-compose restart
```

### ログの確認
```bash
docker-compose logs -f
```

## ファイル構成

```
.
├── docker-compose.yml    # Docker Compose設定
├── Dockerfile           # Laravel用Dockerfile
├── .dockerignore        # Docker除外ファイル
├── setup-laravel.bat    # Windows用セットアップ
├── setup-laravel.sh     # Linux/Mac用セットアップ
├── src/                 # Laravelプロジェクト（自動生成）
└── README.md           # このファイル
``` 