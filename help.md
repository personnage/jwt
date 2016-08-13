# create user (sign up)
http -j -f post 192.168.99.100:8080/register \
username=username \
email=mail@mail.com \
password=123123


# login user (sign in)
http -j -f post 192.168.99.100:8080/login \
username=username \
password=123123

# restrict
http -j -f get localhost:8000/restricted?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsImlhdCI6MTQ3MDU3NDc0MCwiZXhwIjoxNDcwNTc4MzQwLCJuYmYiOjE0NzA1NzQ3NDAsImp0aSI6IjFiNjZlZGNmMDg0NGVkZjAwYTI4ZTAxOTliYzE2NTgwIn0.57UWfjxthn0Gd9oX6NsoYPY59EL8hGnY5ulxm2V0Y_U


# update current user

# set or update name/email
http -f patch localhost:8080/api/v1/user email=mail@mail.com name=name api_token=BRdDMpmmV2WOesb8

# set or update password
http -f patch localhost:8080/api/v1/user/password password=password api_token=BRdDMpmmV2WOesb8

# set or update username
http -f patch localhost:8080/api/v1/user/account username=username api_token=BRdDMpmmV2WOesb8
