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
curl -X POST "http://localhost/api/auth/login" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"example@exam.com","password":"password"}'

```

```javascript
const url = new URL("http://localhost/api/auth/login");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "example@exam.com",
    "password": "password"
}

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

#Base
<!-- START_4e740ed097ab5a038b83f4aa2579ea14 -->
## BaseList

活動拠点一覧

活動拠点を一覧形式で取得する

> Example request:

```bash
curl -X GET -G "http://localhost/api/bases" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/bases");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": "1",
    "name": "北海道",
    "created_at": "Y-m-d H:i:s",
    "updated_at": "Y-m-d H:i:s"
}
```

### HTTP Request
`GET api/bases`


<!-- END_4e740ed097ab5a038b83f4aa2579ea14 -->

#Member
<!-- START_ea4a86a2ebf8f6c1973d97ed30209227 -->
## Create Member

一般ユーザー作成

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/members" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"\u30a2\u30ab\u30a6\u30f3\u30c8\u540d","email":"example@exam.com","password":"password","password_confirmation":"password"}'

```

```javascript
const url = new URL("http://localhost/api/accounts/members");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "\u30a2\u30ab\u30a6\u30f3\u30c8\u540d",
    "email": "example@exam.com",
    "password": "password",
    "password_confirmation": "password"
}

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

### HTTP Request
`POST api/accounts/members`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | アカウント名
    email | string |  required  | ログインするアカウントのメールアドレス
    password | string |  required  | パスワード
    password_confirmation | string |  required  | 確認パスワード

<!-- END_ea4a86a2ebf8f6c1973d97ed30209227 -->

<!-- START_8e0d791641329083d7028255d3e3c51b -->
## Update Member To Stylist

会員をスタイリストに更新する (招待された人が会員だった場合に使用すること)

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/members/memberToStylist" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"example@exam.com","password":"password","invitation_token":"token"}'

```

```javascript
const url = new URL("http://localhost/api/accounts/members/memberToStylist");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "example@exam.com",
    "password": "password",
    "invitation_token": "token"
}

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

### HTTP Request
`POST api/accounts/members/memberToStylist`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | ログインするアカウントのメールアドレス
    password | string |  required  | パスワード
    invitation_token | string |  required  | 招待メールに付いてくるトークン

<!-- END_8e0d791641329083d7028255d3e3c51b -->

#Stylist
<!-- START_fe4538154eb1c4d5a122a259d9a295b1 -->
## Create Stylist

スタイリスト作成

アカウントに使う基本情報とスタイリストとしてこのアプリケーションに登録する。

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/stylists" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"\u30a2\u30ab\u30a6\u30f3\u30c8\u540d","email":"example@exam.com","password":"password","password_confirmation":"password","invitation_token":"token"}'

```

```javascript
const url = new URL("http://localhost/api/accounts/stylists");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "\u30a2\u30ab\u30a6\u30f3\u30c8\u540d",
    "email": "example@exam.com",
    "password": "password",
    "password_confirmation": "password",
    "invitation_token": "token"
}

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

<!-- START_1e69046fec63f90d27faf177eae66349 -->
## Authenticate invitation

招待メール認証

招待トークンと招待したメールアドレスの検証。検証が通れば、現在の自分のアカウントのタイプを返す。(Stylist or Member or Guest)

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/stylists/auth" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"example@exam.com","invitation_token":"token"}'

```

```javascript
const url = new URL("http://localhost/api/accounts/stylists/auth");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "example@exam.com",
    "invitation_token": "token"
}

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
    "message": "The Guest that have this Email and Token is Stylist",
    "is_guest": true,
    "is_stylist": false,
    "is_member": false
}
```

### HTTP Request
`POST api/accounts/stylists/auth`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | 招待メールを送ったメアド
    invitation_token | string |  required  | 招待メールに付いてくるトークン

<!-- END_1e69046fec63f90d27faf177eae66349 -->

<!-- START_1b3e3725dd2384ba7c12a125584307a3 -->
## Invite Stylist

スタイリスト招待

現在ログインしているスタイリストアカウントで招待メールを送る。

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/stylists/invite" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"example@exam.com","recommendation":"Laravel\u306e\u30c9\u30ad\u30e5\u30e1\u30f3\u30c8\u81ea\u52d5\u751f\u6210\u30c4\u30fc\u30eb\u307e\u3058\u3067\u512a\u79c0"}'

```

```javascript
const url = new URL("http://localhost/api/accounts/stylists/invite");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "example@exam.com",
    "recommendation": "Laravel\u306e\u30c9\u30ad\u30e5\u30e1\u30f3\u30c8\u81ea\u52d5\u751f\u6210\u30c4\u30fc\u30eb\u307e\u3058\u3067\u512a\u79c0"
}

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

<!-- START_e83ec4a27eb8294e71bfd7da2b7c2caf -->
## Create Stylist Profile

スタイリストプロフィール作成

> Example request:

```bash
curl -X POST "http://localhost/api/accounts/stylists/profiles" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"introduction":"'\u4ffa\u306f\u5929\u624d\u30b9\u30bf\u30ea\u30b9\u30c8'","birth_date":"19941111","sex":1,"base_id":1}'

```

```javascript
const url = new URL("http://localhost/api/accounts/stylists/profiles");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "introduction": "'\u4ffa\u306f\u5929\u624d\u30b9\u30bf\u30ea\u30b9\u30c8'",
    "birth_date": "19941111",
    "sex": 1,
    "base_id": 1
}

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
`POST api/accounts/stylists/profiles`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    introduction | string |  required  | 自己紹介文
    birth_date | string |  required  | 生年月日
    sex | integer |  required  | 性別：男 = 1, 女 = 2
    base_id | integer |  required  | 拠点ID

<!-- END_e83ec4a27eb8294e71bfd7da2b7c2caf -->


