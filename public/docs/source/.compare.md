---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Auth
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Login

ユーザーログイン

ログインする場合は以下のパラメータを用意すること

> Example request:

```bash
curl -X POST "http://localhost/api/auth/login"     -d "email"="example@exam.com" \
    -d "password"="password" 
```

```javascript
const url = new URL("http://localhost/api/auth/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "example@exam.com",
    "password": "password",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "access_token": "aaaaaaaa",
    "token_type": "bearer",
    "expires_in": 3600
}
```
> Example response (400):

```json
{
    "message": "UnAuthorized"
}
```

### HTTP Request
`POST api/auth/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | ログインするアカウントのメールアドレス
    password | string |  required  | ログインするアカウントのパスワード

<!-- END_a925a8d22b3615f12fca79456d286859 -->

#Stylist
<!-- START_1b3e3725dd2384ba7c12a125584307a3 -->
## Invite Stylist

スタイリスト招待

現在ログインしているスタイリストアカウントで招待メールを送る。

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/stylists/invite"     -d "email"="example@exam.com" \
    -d "recommendation"="Laravelのドキュメント自動生成ツールまじで優秀" 
```

```javascript
const url = new URL("http://localhost/api/accounts/stylists/invite");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "example@exam.com",
    "recommendation": "Laravelのドキュメント自動生成ツールまじで優秀",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (204):

```json
[]
```
> Example response (400):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email must be a valid email address."
        ]
    }
}
```
> Example response (500):

```json
{
    "message": "failed to send invite mail"
}
```

### HTTP Request
`POST api/accounts/stylists/invite`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | 招待するユーザーのメールアドレス
    recommendation | string |  required  | 推薦文

<!-- END_1b3e3725dd2384ba7c12a125584307a3 -->

<!-- START_1e69046fec63f90d27faf177eae66349 -->
## Authenticate invitation

招待メール認証

招待トークンと招待したメールアドレスが一致しているか判定し、一致していればメッセージと現在の自分のアカウントのタイプを返す。
招待メールが既にスタイリストか一般会員で登録されていた場合は is_member か is_stylist が true になる。ゲスト（アカウント持ってない）だった場合は is_guest が true になる。
３つの内どれか一つがtrueだった場合は他はfalseになる。

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/stylists/auth"     -d "email"="example@exam.com" \
    -d "invitation_token"="token" 
```

```javascript
const url = new URL("http://localhost/api/accounts/stylists/auth");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "example@exam.com",
    "invitation_token": "token",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{}
```

### HTTP Request
`POST api/accounts/stylists/auth`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | 招待メールを送ったメアド
    invitation_token | string |  required  | 招待メールに付いてくるトークン

<!-- END_1e69046fec63f90d27faf177eae66349 -->

<!-- START_fe4538154eb1c4d5a122a259d9a295b1 -->
## Create Stylist

スタイリスト作成

アカウントに使う基本情報とスタイリストとしてこのアプリケーションにに登録する。スタイリストのプロフィール作成APIではない。

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/stylists"     -d "name"="アカウント名" \
    -d "email"="example@exam.com" \
    -d "password"="password" \
    -d "password_confirmation"="password" \
    -d "invitation_token"="token" 
```

```javascript
const url = new URL("http://localhost/api/accounts/stylists");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "name": "アカウント名",
    "email": "example@exam.com",
    "password": "password",
    "password_confirmation": "password",
    "invitation_token": "token",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "access_token": "token",
    "token_type": "bearer",
    "expires_in": 3600
}
```
> Example response (400):

```json
{
    "message": "UnAuthorized"
}
```

### HTTP Request
`POST api/accounts/stylists`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | アカウント名
    email | string |  required  | ログインするアカウントのメールアドレス
    password | string |  required  | パスワード
    password_confirmation | string |  required  | 確認パスワード
    invitation_token | string |  required  | 招待トークン

<!-- END_fe4538154eb1c4d5a122a259d9a295b1 -->


