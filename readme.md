# A Basic Secure Login Implementation 
[![CodeFactor](https://www.codefactor.io/repository/github/sigmanificient/secure_login/badge)](https://www.codefactor.io/repository/github/sigmanificient/secure_login)
- Hashed & Salted password  ( only hashed in ShA-512 for now )
- No SQL injection possible
- Prevent XSS attacks from the login form
- Ban IP after too many failed attempts (3 by default)
- Session & Token to prevent CSRF attacks later on

## Warning !
### Dont use this without SSL, elsewhere all credentials would be sent in clear. 
