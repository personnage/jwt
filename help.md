# Base example

## Sign Up

### Create user (John Doe)
    http -j -f post 192.168.99.100:8080/register \
    username='John Doe' \
    email=john@example.com \
    password=1234567

#### Answer
    HTTP/1.1 201 Created
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:27:39 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIiwic3ViIjo1LCJpc3MiOiJodHRwOlwvXC8xOTIuMTY4Ljk5LjEwMDo4MDgwXC9yZWdpc3RlciIsImlhdCI6MTQ3MTA4NDA1OSwiZXhwIjoxNDcxMDg3NjU5LCJuYmYiOjE0NzEwODQwNTksImp0aSI6ImVhNWZhYzMzMGNmOTYxOWIwMzIzNTFmZmZmMDU2MDcyIn0.1LVOyERVVc8WrU4xdWGqbZTBmBgBfeAS33n1Dg8ETCM"
    }

##### Payload
    {
      "email": "john@example.com",
      "username": "John Doe",
      "sub": 5,
      "iss": "http://192.168.99.100:8080/register",
      "iat": 1471084059,
      "exp": 1471087659,
      "nbf": 1471084059,
      "jti": "ea5fac330cf9619b032351ffff056072"
    }

### Create user (Judy Doe)
    http -j -f post 192.168.99.100:8080/register \
    username='Judy Doe' \
    email=judy@example.com \
    password=1234567

#### Answer
    HTTP/1.1 201 Created
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:28:19 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imp1ZHlAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ikp1ZHkgRG9lIiwic3ViIjo2LCJpc3MiOiJodHRwOlwvXC8xOTIuMTY4Ljk5LjEwMDo4MDgwXC9yZWdpc3RlciIsImlhdCI6MTQ3MTA4NDA5OSwiZXhwIjoxNDcxMDg3Njk5LCJuYmYiOjE0NzEwODQwOTksImp0aSI6ImM5M2MzNjkxYTgzODc5OGMwY2YyOTYyYmE5NmM5MDA5In0.J9yJ4bLHfFyyvb_bb1v5PzGKZaYPAW80U8mOzXKBnUM"
    }

##### Payload
    {
      "email": "judy@example.com",
      "username": "Judy Doe",
      "sub": 6,
      "iss": "http://192.168.99.100:8080/register",
      "iat": 1471084099,
      "exp": 1471087699,
      "nbf": 1471084099,
      "jti": "c93c3691a838798c0cf2962ba96c9009"
    }


### Create user (Judy Snow) Bad email!
    http -j -f post 192.168.99.100:8080/register \
    username='Judy Snow' \
    email=judy@example.com \
    password=1234567

##### Answer
    HTTP/1.1 422 Unprocessable Entity
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:30:23 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    {
        "email": [
            "The email has already been taken."
        ]
    }

---

## Sign In

### Login user (John Doe)
    http -j -f post 192.168.99.100:8080/login \
    username='John Doe' \
    password=1234567

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:32:50 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjUsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2xvZ2luIiwiaWF0IjoxNDcxMDg0MzcwLCJleHAiOjE0NzEwODc5NzAsIm5iZiI6MTQ3MTA4NDM3MCwianRpIjoiZmFjZGExMDk2MDZlOTFlNDhmYTM3ODExMzE5NjhlYmYifQ.GP40hgHbaPBmFo-7TZW1-Olj2OpboA9Wi8iG72mWRKs"
    }

##### Payload
    {
      "sub": 5,
      "iss": "http://192.168.99.100:8080/login",
      "iat": 1471084370,
      "exp": 1471087970,
      "nbf": 1471084370,
      "jti": "facda109606e91e48fa3781131968ebf"
    }

### Login user (Judy Doe)
    http -j -f post 192.168.99.100:8080/login \
    username='Judy Doe' \
    password=1234567

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:34:57 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjYsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2xvZ2luIiwiaWF0IjoxNDcxMDg0NDk3LCJleHAiOjE0NzEwODgwOTcsIm5iZiI6MTQ3MTA4NDQ5NywianRpIjoiYTJiM2VmNTU5MjA1MzgwODQzZTkxZWFmN2RkMjc5NmQifQ.GVCOZx63pzCHBZ3BjJxgrP5mGnMJOgVliU2rDis-7CE"
    }

##### Payload
    {
      "sub": 6,
      "iss": "http://192.168.99.100:8080/login",
      "iat": 1471084497,
      "exp": 1471088097,
      "nbf": 1471084497,
      "jti": "a2b3ef559205380843e91eaf7dd2796d"
    }

### Login user (Not credentials)
    http -j -f post 192.168.99.100:8080/login

#### Answer
    HTTP/1.1 422 Unprocessable Entity
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:36:22 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
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
    http -j -f get 192.168.99.100:8080/home

#### Answer
    HTTP/1.1 400 Bad Request
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:41:13 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    {
        "error": "token_not_provided"
    }

### Token invalid
    http -j -f get 192.168.99.100:8080/home \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIiwic3ViIjo1LCJpc3MiOiJodHRwOlwvXC8xOTIuMTY4Ljk5LjEwMDo4MDgwXC9yZWdpc3RlciIsImlhdCI6MTQ3MTA4NDA1OSwiZXhwIjoxNDcxMDg3NjU5LCJuYmYiOjE0NzEwODQwNTksImp0aSI6ImVhNWZhYzMzMGNmOTYxOWIwMzIzNTFmZmZmMDU2MDcyIn0.1LVOyERVVc8WrU4xdWGqbZTBmBgBfeAS33n1Dg8ETCX'

#### Answer
    HTTP/1.1 400 Bad Request
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:50:29 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    {
        "error": "token_invalid"
    }

### Access allowed
    http -j -f get 192.168.99.100:8080/home \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIiwic3ViIjo1LCJpc3MiOiJodHRwOlwvXC8xOTIuMTY4Ljk5LjEwMDo4MDgwXC9yZWdpc3RlciIsImlhdCI6MTQ3MTA4NDA1OSwiZXhwIjoxNDcxMDg3NjU5LCJuYmYiOjE0NzEwODQwNTksImp0aSI6ImVhNWZhYzMzMGNmOTYxOWIwMzIzNTFmZmZmMDU2MDcyIn0.1LVOyERVVc8WrU4xdWGqbZTBmBgBfeAS33n1Dg8ETCM'

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sat, 13 Aug 2016 10:48:42 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9

    [
        "Welcome"
    ]
