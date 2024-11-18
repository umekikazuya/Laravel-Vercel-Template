# Laravel-Vercel-Template

## 概要
Vercel環境にLaravelアプリケーションをセットアップする手順書です。

**※ 本リポジトリをCloneしてそのまま使うことも可能。**

## 手順
### 1. Laravelインストール
#### 001. Laravelインストール
```bash
composer create-project laravel/laravel
```


#### 002. Vercel接続設定
```bash
composer require revolution/laravel-vercel-installer --dev
php artisan vercel:install
```

#### 003. PHPランタイム設定
[vercel.json](https://github.com/umekikazuya/Laravel-Vercel-Template/blob/main/vercel.json)を修正します。

以下、バージョンだとPHP8.3に対応。
```json
"runtime": "vercel-php@0.7.3"
```

### 2. Vercelの設定
#### 001. リポジトリのインポート
#### 002. APP_KEYを環境変数設定
