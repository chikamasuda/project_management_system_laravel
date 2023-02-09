# 環境構築
※Laravel Sailを使用。事前にDockerのインストール要。

1. git cloneを行う  
```
https://github.com/chikamasuda/project_management_system_laravel.git
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
4. Dockerコンテナを停止する場合
```
./vendor/bin/sail down
```
