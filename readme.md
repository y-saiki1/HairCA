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

*:警告:ここからはdockerコンテナの中に入って作業するので、macとdockerコンテナのターミナルが別れていることに気をつけましょう。*


9.  laradock内で `docker-compose exec workspace bash` を実行。エラーが起こったら`docker-compose up -d workspace`を実行。


10.   dockerコンテナの中に入れたら `cd hairCA_laravel_API` を実行。


11.   `hairCA_laravel_API`の中で`composer install`を実行する。


12.   終わったら、`php artisan list`を入力する。


13.   問題なくコマンドヘルプが表示されたら完了です。


14.   好きなブラウザで`http://localhost/docs/index.html` を叩くとドキュメントが表示されるのでこれでフロント開発に進めるはずです！