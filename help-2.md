# ttl 1 min
# refresh ttl 2

1) create
http -j -f post 192.168.99.100:8080/api/v1/register \
username='John Doe' \
email=john@example.com \
password=1234567

2) login
http -j -f post 192.168.99.100:8080/api/v1/login \
username='John Doe' \
password=1234567

3) debug token (get payload)


4) restrict
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTc0NzA3LCJleHAiOjE0NzExNzQ3NjcsIm5iZiI6MTQ3MTE3NDcwNywianRpIjoiNGYxNDNhZTg3YzMzYmFkODM0YmRlM2YyZDU3Njk0YTMiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.pBMRApYRfvZ_eAlI-DDyginXfNv05WcHoKHhGZDyS7Y'

5) answer
HTTP/1.1 200 OK
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 11:31:27 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
{
    "created_at": "2016-08-14 11:31:06",
    "current_sign_in_at": "2016-08-14 11:31:11",
    "current_sign_in_ip": "192.168.99.1",
    "deleted_at": null,
    "email": "john@example.com",
    "failed_attempts": 0,
    "id": 1,
    "last_sign_in_at": null,
    "last_sign_in_ip": null,
    "name": null,
    "sign_in_count": 1,
    "updated_at": "2016-08-14 11:31:11",
    "username": "John Doe"
}

6) wait 1 min

7) repeat restrict
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTc0MjcxLCJleHAiOjE0NzExNzQzMzEsIm5iZiI6MTQ3MTE3NDI3MSwianRpIjoiYjdlYjg1ZTEyNDZiYTBiNWZkNDA2MGUzNzdkMjJhMDkiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.SRV9mhT5xb_ki33g8UppixGkN5oJ412VJgcPfshW_6M'

8) answer
HTTP/1.1 401 Unauthorized
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:15:42 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 49
{
    "error": "token_expired"
}


9) refresh token
http -j -f post 192.168.99.100:8080/api/v1/token/refresh/force \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTc0NzA3LCJleHAiOjE0NzExNzQ3NjcsIm5iZiI6MTQ3MTE3NDcwNywianRpIjoiNGYxNDNhZTg3YzMzYmFkODM0YmRlM2YyZDU3Njk0YTMiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.pBMRApYRfvZ_eAlI-DDyginXfNv05WcHoKHhGZDyS7Y'

10) payload


11) restrict (new token)
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL3Rva2VuXC9yZWZyZXNoXC9mb3JjZSIsImlhdCI6MTQ3MTE3NDI3MSwiZXhwIjoxNDcxMTc0Mzk2LCJuYmYiOjE0NzExNzQzMzYsImp0aSI6ImZjNzE1ZjJiZWYyYTJhOTVlYjZkMTQ3MWE2NjlkYjAzIiwibmFtZSI6bnVsbCwiZW1haWwiOiJqb2huQGV4YW1wbGUuY29tIiwidXNlcm5hbWUiOiJKb2huIERvZSJ9.4IGHgYe1mpc9FXn-iy-VVCI9PyUcAZ2S43elpi5nhME'

12) asnwer
HTTP/1.1 200 OK
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:16:21 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
{
    "created_at": "2016-08-14 10:14:33",
    "current_sign_in_at": "2016-08-14 10:14:40",
    "current_sign_in_ip": "192.168.99.1",
    "deleted_at": null,
    "email": "john@example.com",
    "failed_attempts": 0,
    "id": 1,
    "last_sign_in_at": null,
    "last_sign_in_ip": null,
    "name": null,
    "sign_in_count": 1,
    "updated_at": "2016-08-14 10:14:40",
    "username": "John Doe"
}

13) wait 1 min

14) restrict repeat (new token)
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer '

15) aswer
HTTP/1.1 401 Unauthorized
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:17:02 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 50
{
    "error": "token_expired"
}

16) refresh token
http -j -f post 192.168.99.100:8080/api/v1/token/refresh \
Authorization:'Bearer '

17) error
Token has expired and can no longer be refreshed!

---

18) repeat login
http -j -f post 192.168.99.100:8080/api/v1/login \
username='John Doe' \
password=1234567

19) payload


20) restrict repeat
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer '

21) asnwer
HTTP/1.1 200 OK
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:20:07 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
{
    "created_at": "2016-08-14 10:14:33",
    "current_sign_in_at": "2016-08-14 10:19:31",
    "current_sign_in_ip": "192.168.99.1",
    "deleted_at": null,
    "email": "john@example.com",
    "failed_attempts": 0,
    "id": 1,
    "last_sign_in_at": "2016-08-14 10:14:40",
    "last_sign_in_ip": "192.168.99.1",
    "name": null,
    "sign_in_count": 2,
    "updated_at": "2016-08-14 10:19:31",
    "username": "John Doe"
}

22) wait 1 min
HTTP/1.1 401 Unauthorized
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:20:38 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 56
{
    "error": "token_expired"
}

23) refresh token
http -j -f post 192.168.99.100:8080/api/v1/token/refresh \
Authorization:'Bearer '

24) payload
{
  "sub": 1,
  "iss": "http://192.168.99.100:8080/api/v1/refresh",
  "iat": 1471169971,
  "exp": 1471170123,
  "nbf": 1471170063,
  "jti": "60d01786139ab7b88329b6c3c4c560c5",
  "name": null,
  "email": "john@example.com",
  "username": "John Doe"
}

25) restrict
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer '

26) answer
HTTP/1.1 200 OK
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:21:37 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
{
    "created_at": "2016-08-14 10:14:33",
    "current_sign_in_at": "2016-08-14 10:19:31",
    "current_sign_in_ip": "192.168.99.1",
    "deleted_at": null,
    "email": "john@example.com",
    "failed_attempts": 0,
    "id": 1,
    "last_sign_in_at": "2016-08-14 10:14:40",
    "last_sign_in_ip": "192.168.99.1",
    "name": null,
    "sign_in_count": 2,
    "updated_at": "2016-08-14 10:19:31",
    "username": "John Doe"
}
