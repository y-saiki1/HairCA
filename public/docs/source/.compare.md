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

#general
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## api/auth/login
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
> Example response (401):

```json
{
    "error": "Unauthrized"
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

<!-- START_94726cef0a53b660e0f38207f65ad3e6 -->
## api/auth/invite
> Example request:

```bash
curl -X POST "http://localhost/api/auth/invite"     -d "email"="example@exam.com" 
```

```javascript
const url = new URL("http://localhost/api/auth/invite");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "example@exam.com",
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
    "error": "failed to send invite mail"
}
```

### HTTP Request
`POST api/auth/invite`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | 招待されるユーザーのメールアドレス

<!-- END_94726cef0a53b660e0f38207f65ad3e6 -->


