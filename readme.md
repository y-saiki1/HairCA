# Laravel環境構築

1.  `docker for macをいれた状態`で、`hairca_dirディレクトリ`を作成。


2.  `hairca_dirディレクトリ`に `laradock.zip` を入れ、解凍する。


3.  解凍後、`laradockディレクトリ`が作成されている。`laradock.zip`を削除する。


4.  `laradockディレクトリ`の中に入る。


5.  `docker-compose up -d nginx mysql redis` を実行


6.  ビルド後、`laradock`と同階層で`gitlabのhairCA_laravel_API`をclone 


7.  現在のディレクトリ構造↓

**hairca_dir/laradock**


**hairca_dir/hairCA_laravel_API**



8.  slackに置いてある`.envファイル`を `hairca_dir/hairCA_laravel_API直下`に入れる。

**:警告:ここからはdockerコンテナの中に入って作業するので、macとdockerコンテナのターミナルが別れていることに気をつけましょう。**


9.  laradock内で `docker-compose exec workspace bash` を実行。エラーが起こったら`docker-compose up -d workspace`を実行。


10.   dockerコンテナの中に入れたら `cd hairCA_laravel_API` を実行。


11.   `hairCA_laravel_API`の中で`composer install`を実行する。


12.   終わったら、`php artisan list`を入力する。


13.   問題なくコマンドヘルプが表示されたら完了です。


14.   好きなブラウザで`http://localhost/docs/index.html` を叩くとドキュメントが表示されるのでこれでフロント開発に進めるはずです！

# DB環境構築
1.  なんかエラー出たぞコラァって人編


1. まずlaradock直下にいく。`cd hairca_dir/laradock`

2.  直下で、次のコマンドを入力。`docker-compose exec mysql bash`

3. :警告:docker コンテナ内↓


`mysql -u root -p`


`パスワード入力を要求されるので 「root」と入れてください。`

4.  :警告:mysql内↓
`create database hairca`
`exit`

5.  :警告:dockerコンテナ内↓


`exit`

6.  ↑までできたらmacのターミナルまで戻ってきているはずです。

7.  laradockの直下にいるはずなので、`docker-compose exec workspace bash`を実行。

8.  :警告:docker コンテナ内↓


`cd hairCA_laravel_API`


`php artisan migrate --seed`


`php artisan db:seed --class UserSeeder`


上のコマンドを全てdockerコンテナ内で実行すること。

9.  これでDBに伊藤カイジと遠藤さんの二人ができているはずです。

11.  DBに登録されるユーザーの情報は以下に記載されています。


`hairCA_laravel_API/database/seeds `