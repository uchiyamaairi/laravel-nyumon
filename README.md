# 環境構築

本章を学ぶために、下記のアプリケーションが必要です。

1. Docker
2. Visual Studio Code
3. Git

インストールやセットアップの方法については3章で説明します。

# テスト実行の仕方

必ず上記の環境構築にて、Laravel Railwayに取り組むための環境を整えてください。

Visual Studio Codeを使用してコードを編集し、「TechTrain Railway」という拡張機能から「できた!」と書かれた青いボタンをクリックすると判定が始まります。

詳細にテストを実施したい場合は、下記コマンドのStation番号を変更し、実行します。
```bash
# Station1のテストをする場合
docker compose exec php-container vendor/bin/phpunit tests/Feature/LaravelNyumon/Station1
```
