# Laravel 11 Docker API セットアップ手順

## 概要
Laravel 11をDockerで構築し、API専用環境をセットアップする手順です。

## 環境構成
- PHP 8.2 (FPM)
- Nginx
- MySQL 8.0
- Redis
- Laravel 11

## セットアップ手順

### 1. Dockerコンテナの起動
```bash
docker-compose up -d
```

### 2. Laravel 11のインストール
```bash
docker-compose exec app composer create-project laravel/laravel .
```

### 3. API専用構成のインストール
```bash
docker-compose exec app php artisan install:api
```

### 4. 重要な修正（RouteServiceProvider）
- `src/app/Providers/RouteServiceProvider.php` を作成
- `src/bootstrap/providers.php` に `App\Providers\RouteServiceProvider::class` を追加

### 5. キャッシュクリア
```bash
docker-compose exec app php artisan route:clear
```

## APIエンドポイント
- `GET /api/test` - テスト用API（{"message":"ok"}を返す）

## トラブルシューティング

### 404エラーの場合
1. `RouteServiceProvider` が存在するか確認
2. `bootstrap/providers.php` に登録されているか確認
3. ルートキャッシュをクリア

### ポート競合の場合
- MySQL（3306）が他のプロセスで使用されている場合は、`docker-compose.yml` のポート設定を変更

## 便利なコマンド
```bash
# ルート一覧表示
docker-compose exec app php artisan route:list

# コンテナログ確認
docker-compose logs webserver

# コンテナ再起動
docker-compose restart
``` 