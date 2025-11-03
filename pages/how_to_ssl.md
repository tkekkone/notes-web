# Cheat sheet to create certificates

Generate CA key and certificate

```
openssl genrsa -des3 -out ca.key 4096
openssl req -new -x509 -days 365 -key ca.key -out ca.crt
```

Create server key and a signing request. -des3 for encryption and will prompt for password. Can use -passout to give passphrase on command.

```
openssl genrsa -des3 -out server.key 4096
openssl req -new -key server.key -out server.csr -subj "/CN=$(hostname)"
```

Sign the request with the ca key created before. Serial should be different for each cert created by CA. So incremenmt for next or use random enough

```
openssl x509 -req -extfile <(printf "subjectAltName=DNS:localhost,DNS:$(hostname)") -days 365 -in server.csr \
-CA ca.crt -CAkey ca.key -set_serial 01 -out server.crt
```

Create client certificate. Same as server cert and key..

```
openssl genrsa -des3 -out client.key 4096
openssl req -new -key client.key -out client.csr
openssl x509 -req -days 365 -in client.csr -CA ca.crt -CAkey ca.key -set_serial 01 -out client.crt
```

If the server demands purpose flags or extensions on the certificate this sometimes helps instead of last one.
```
openssl x509 -req -days 365 -in client.csr -CA ca.crt -purpose -extfile  \
<(printf "subjectAltName=DNS:root\nkeyUsage=digitalSignature") -CAkey ca.key -set_serial 01 -out client.crt
```

Package to p12 format for windows if needed

```
openssl pkcs12 -export -clcerts -in client.crt -inkey client.key -out client.p12
```

If you need revocation lists

```
mkdir demoCA
echo 01 > demoCA/crlnumber
touch demoCA/index.txt
openssl ca -keyfile ca.key -cert ca.crt -gencrl -out ca.crl

```

If needed to remove the password from key. This will prompt for password and write to no-password file.
```
openssl rsa -in client.key -out clientkey.pem
```


If you need to convert to der.

```
openssl x509 -in server.crt -out server.der -outform DER
```

Renewal is easy with x509toreq


Create key first

```
openssl genrsa -out server.key 2048
```

Then create signing request
```
openssl x509 -x509toreq -in old.crt -out server.csr -signkey server.key
```
