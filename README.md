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
1. Vercel Consoleにアクセス
2. Githubからリポジトリをインポートしプロジェクトを作成

#### 002. APP_KEYを環境変数設定
1. Settingsから環境変数を設定する。

### 3. APIルートを利用する方法
#### 001. distディレクトリを作成
`dist/.gitkeep`を作成します。

#### 002. `artisan`コマンドでAPI設定
```bash
php artisan install:api
```
以下、2点変更差分が入ればOK.
- `routes/api.php`が作成される
- `bootstrap/app.php`に`api`ルートが設定される

#### 003. `bootstrap/app.php`にて、APIのPrefixを変更
Laravel標準の`api`ルートは、`{HOST}/api/test`であるがVercel環境だと使えない前提があるので、`bootstrap/app.php`に一行追加する。

```diff
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
+         apiPrefix: 'backend',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

#### 004. (例)サンプルのAPI実装
1. `routes/api.php`にルートを設定。
```php:routes/api.php
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'This API is working!',
        'version' => '1.0.0',
    ])
});
```

2. キャッシュクリア
```bash
php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear
```

3. ルートの確認
```bash
php artisan route:list
```

4. 動作確認
`{HOST}/api/test`にアクセスし動作を確認する。

## Local環境起動
```bash
php artisan serve
```
