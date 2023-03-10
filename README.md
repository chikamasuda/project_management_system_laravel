# 環境構築
※Laravel Sailを使用。事前にDockerのインストール要。

1. git cloneを行う  
```
git clone https://github.com/chikamasuda/project_management_system_laravel.git
```

2. Composer依存関係のインストール  
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

3. Dockerコンテナの立ち上げ 
```
./vendor/bin/sail up -d
```

4. envファイル作成  
```
cp .env.example .env
```

5. 暗号キー設定
```
./vendor/bin/sail artisan key:generate
```

6. Dockerコンテナを停止する場合
```
./vendor/bin/sail down
```

## Laravel Passportインストール
```bash
composer require laravel/passport
./vendor/bin/sail artisan passport:install
./vendor/bin/sail artisan passport:client --password
```
