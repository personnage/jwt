# ttl 1 min
# refresh ttl 20160

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
{
  "sub": 1,
  "iss": "http://192.168.99.100:8080/api/v1/login",
  "iat": 1471169076,  Sun, 14 Aug 2016 10:04:36 GMT
  "exp": 1471169136,  Sun, 14 Aug 2016 10:05:36 GMT
  "nbf": 1471169076,  Sun, 14 Aug 2016 10:04:36 GMT
  "jti": "0947edc66429cf098e894812c75687f2",
  "name": null,
  "email": "john@example.com",
  "username": "John Doe"
}

4) restrict
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTY5MDc2LCJleHAiOjE0NzExNjkxMzYsIm5iZiI6MTQ3MTE2OTA3NiwianRpIjoiMDk0N2VkYzY2NDI5Y2YwOThlODk0ODEyYzc1Njg3ZjIiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.gj9G0jiCD-Crku5NPU7GFY9CoSN4lNaBWLnzeqZTQto'

5) answer
HTTP/1.1 200 OK
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:00:09 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
{
    "created_at": "2016-08-14 09:59:26",
    "current_sign_in_at": "2016-08-14 09:59:34",
    "current_sign_in_ip": "192.168.99.1",
    "deleted_at": null,
    "email": "john@example.com",
    "failed_attempts": 0,
    "id": 1,
    "last_sign_in_at": null,
    "last_sign_in_ip": null,
    "name": null,
    "sign_in_count": 1,
    "updated_at": "2016-08-14 09:59:34",
    "username": "John Doe"
}


6) wait 1 min

7) repeat restrict
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTY5MDc2LCJleHAiOjE0NzExNjkxMzYsIm5iZiI6MTQ3MTE2OTA3NiwianRpIjoiMDk0N2VkYzY2NDI5Y2YwOThlODk0ODEyYzc1Njg3ZjIiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.gj9G0jiCD-Crku5NPU7GFY9CoSN4lNaBWLnzeqZTQto'

8) answer
HTTP/1.1 401 Unauthorized
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:05:40 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 56
{
    "error": "token_expired"
}


9) refresh token
http -j -f post 192.168.99.100:8080/api/v1/refresh \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxMTY5MDc2LCJleHAiOjE0NzExNjkxMzYsIm5iZiI6MTQ3MTE2OTA3NiwianRpIjoiMDk0N2VkYzY2NDI5Y2YwOThlODk0ODEyYzc1Njg3ZjIiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.gj9G0jiCD-Crku5NPU7GFY9CoSN4lNaBWLnzeqZTQto'

10) payload
{
  "sub": 1,
  "iss": "http://192.168.99.100:8080/api/v1/refresh",
  "iat": 1471169076,  Sun, 14 Aug 2016 10:04:36 GMT
  "exp": 1471169245,  Sun, 14 Aug 2016 10:07:25 GMT
  "nbf": 1471169185,  Sun, 14 Aug 2016 10:06:25 GMT
  "jti": "61cc5a1e2f9f606f5453474f246e43d0",
  "name": null,
  "email": "john@example.com",
  "username": "John Doe"
}

11) restrict (new token)
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL3JlZnJlc2giLCJpYXQiOjE0NzExNjkwNzYsImV4cCI6MTQ3MTE2OTI0NSwibmJmIjoxNDcxMTY5MTg1LCJqdGkiOiI2MWNjNWExZTJmOWY2MDZmNTQ1MzQ3NGYyNDZlNDNkMCIsIm5hbWUiOm51bGwsImVtYWlsIjoiam9obkBleGFtcGxlLmNvbSIsInVzZXJuYW1lIjoiSm9obiBEb2UifQ.C0tjts8-9shNpgjk4H3YxldMiwAPb2bZfA3PQtzjNfM'

12) asnwer
HTTP/1.1 200 OK
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:06:55 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 57
{
    "created_at": "2016-08-14 10:04:31",
    "current_sign_in_at": "2016-08-14 10:04:36",
    "current_sign_in_ip": "192.168.99.1",
    "deleted_at": null,
    "email": "john@example.com",
    "failed_attempts": 0,
    "id": 1,
    "last_sign_in_at": null,
    "last_sign_in_ip": null,
    "name": null,
    "sign_in_count": 1,
    "updated_at": "2016-08-14 10:04:36",
    "username": "John Doe"
}

13) wait 1 min

14) restrict repeat
http -j -f get 192.168.99.100:8080/api/v1/home \
Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2FwaVwvdjFcL3JlZnJlc2giLCJpYXQiOjE0NzExNjkwNzYsImV4cCI6MTQ3MTE2OTI0NSwibmJmIjoxNDcxMTY5MTg1LCJqdGkiOiI2MWNjNWExZTJmOWY2MDZmNTQ1MzQ3NGYyNDZlNDNkMCIsIm5hbWUiOm51bGwsImVtYWlsIjoiam9obkBleGFtcGxlLmNvbSIsInVzZXJuYW1lIjoiSm9obiBEb2UifQ.C0tjts8-9shNpgjk4H3YxldMiwAPb2bZfA3PQtzjNfM'

15) aswer
HTTP/1.1 401 Unauthorized
Cache-Control: no-cache
Connection: close
Content-Type: application/json
Date: Sun, 14 Aug 2016 10:07:57 GMT
Host: 192.168.99.100:8080
X-Powered-By: PHP/7.0.9
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 56

{
    "error": "token_expired"
}
