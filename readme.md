１docker for macをいれた状態で、hairca_dirディレクトリを作成。

２hairca_dirディレクトリに laradock.zip を入れ、解凍する。

３解凍後、laradockディレクトリが作成されている。laradock.zipを削除する。

４laradockディレクトリの中に入る。

５「docker-compose up -d nginx mysql redis」 を実行

６ビルド後、laradockと同階層でgitlabのhairCA_laravel_APIをclone

７現在のディレクトリ構造↓

hairca_dir/laradock
hairca_dir/hairCA_laravel_API

８slackに置いてある.envを hairca_dir/hairCA_laravel_API直下に入れる。

:警告:ここからはdockerコンテナの中に入って作業するので、macとdockerコンテナのターミナルが別れていることに気をつけましょう。

９laradock内で 「docker-compose exec workspace bash」 を実行。エラーが起こったら「docker-compose up -d workspace」を実行。

10 dockerコンテナの中に入れたら 「cd hairCA_laravel_API」 を実行。

11 hairCA_laravel_APIの中で「composer install」を実行する。

12 終わったら、「php artisan list」を入力する。

13 問題なくコマンドヘルプが表示されたら完了です。

14 好きなブラウザで「http://localhost/docs/index.html」 を叩くとドキュメントが表示されるのでこれでフロント開発に進めるはずです！