# Base example

## Sign Up

### Create user (John Doe)
    http -j -f post 192.168.99.100:8080/api/v1/register \
    username='John Doe' \
    email=john@example.com \
    password=1234567

#### Answer
    HTTP/1.1 201 Created
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:20:24 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "ok": true
    }

### Create user (Judy Doe)
    http -j -f post 192.168.99.100:8080/api/v1/register \
    username='Judy Doe' \
    email=judy@example.com \
    password=1234567

#### Answer
    HTTP/1.1 201 Created
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:20:45 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    {
        "ok": true
    }

### Create user (Judy Snow) Bad email!
    http -j -f post 192.168.99.100:8080/api/v1/register \
    username='Judy Snow' \
    email=judy@example.com \
    password=1234567

##### Answer
    HTTP/1.1 422 Unprocessable Entity
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:21:06 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 57
    {
        "email": [
            "The email has already been taken."
        ]
    }

---

## Sign In

### Login user (John Doe)
    http -j -f post 192.168.99.100:8080/api/v1/login \
    username='John Doe' \
    password=1234567

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:21:24 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTYyODg0LCJleHAiOjE0NzExNjY0ODQsIm5iZiI6MTQ3MTE2Mjg4NCwianRpIjoiMTEyYmZhYmM3ZWYzOTk2ZDA5ZTkwNjExNjQ3MWNmMDYiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.AewqGz3Lpnl7_utRmTTw-hxQ_M_0NEQomYz2s7HLhKM"
    }

##### Payload
    {
      "sub": 1,
      "iss": "http://192.168.99.100:8080/api/v1/login",
      "iat": 1471162884,
      "exp": 1471166484,
      "nbf": 1471162884,
      "jti": "112bfabc7ef3996d09e906116471cf06",
      "name": null,
      "email": "john@example.com",
      "username": "John Doe"
    }

### Login user (Judy Doe)
    http -j -f post 192.168.99.100:8080/api/v1/login \
    username='Judy Doe' \
    password=1234567

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:22:08 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTYyOTI4LCJleHAiOjE0NzExNjY1MjgsIm5iZiI6MTQ3MTE2MjkyOCwianRpIjoiYzY1Nzg3MWEyZDI3ZDExMzA5ZDNlZmNmZDdhMTBkYjYiLCJuYW1lIjpudWxsLCJlbWFpbCI6Imp1ZHlAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ikp1ZHkgRG9lIn0.PV3gHm8lzu3BJpoXMwpfNnRyQ_PMbe_ILtc6TpF_KAs"
    }

##### Payload
    {
      "sub": 2,
      "iss": "http://192.168.99.100:8080/api/v1/login",
      "iat": 1471162928,
      "exp": 1471166528,
      "nbf": 1471162928,
      "jti": "c657871a2d27d11309d3efcfd7a10db6",
      "name": null,
      "email": "judy@example.com",
      "username": "Judy Doe"
    }

### Login user (Not credentials)
    http -j -f post 192.168.99.100:8080/api/v1/login

#### Answer
    HTTP/1.1 422 Unprocessable Entity
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:22:35 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 57
    {
        "password": [
            "The password field is required."
        ],
        "username": [
            "The username field is required."
        ]
    }


---

## Restrict (Authorization: Bearer <token>)

### Token missing
    http -j -f get 192.168.99.100:8080/api/v1/home

#### Answer
    HTTP/1.1 400 Bad Request
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:22:56 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59

    {
        "error": "token_not_provided"
    }

### Token invalid
    http -j -f get 192.168.99.100:8080/api/v1/home \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIiwic3ViIjo1LCJpc3MiOiJodHRwOlwvXC8xOTIuMTY4Ljk5LjEwMDo4MDgwXC9yZWdpc3RlciIsImlhdCI6MTQ3MTA4NDA1OSwiZXhwIjoxNDcxMDg3NjU5LCJuYmYiOjE0NzEwODQwNTksImp0aSI6ImVhNWZhYzMzMGNmOTYxOWIwMzIzNTFmZmZmMDU2MDcyIn0.1LVOyERVVc8WrU4xdWGqbZTBmBgBfeAS33n1Dg8ETCX'

#### Answer
    HTTP/1.1 400 Bad Request
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:23:20 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    {
        "error": "token_invalid"
    }

### Access allowed
    http -j -f get 192.168.99.100:8080/api/v1/home \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTY1NDc5LCJleHAiOjE0NzExNjkwNzksIm5iZiI6MTQ3MTE2NTQ3OSwianRpIjoiNTdlYjk0MGM2OTYxNDZiZDE1NTcxYzhiZDNmODk0MTAiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.tQVdLSJaVc42zZheTC4ysKgl37e9akXiypa7Ydxdx8w'

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:25:10 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "created_at": "2016-08-14 08:20:24",
        "current_sign_in_at": "2016-08-14 08:21:24",
        "current_sign_in_ip": "192.168.99.1",
        "deleted_at": null,
        "email": "john@example.com",
        "failed_attempts": 0,
        "id": 1,
        "last_sign_in_at": null,
        "last_sign_in_ip": null,
        "name": null,
        "sign_in_count": 1,
        "updated_at": "2016-08-14 08:21:24",
        "username": "John Doe"
    }
