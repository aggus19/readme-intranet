
# S.d.B.E Agras Systems - Intranet

"Agras Systems - Intranet" is a **digital platform** intended for **educational centers** in order to **promote accessibility to different types of multimedia** (books, music, etc.) to all educational institutions that purchase the digital platform.
## Roles

| Role | Number     | Description                |
| :-------- | :------- | :------------------------- |
| `0` | `Visitante` | ⛔ **(No Admin perms)**. Visitor. |
| `1` | `Usuario` | ⛔ **(No Admin perms)**. Educational User. |
| `2` | `Administrador` | ✅ **(Exclusive perms)**. Administrador. |
| `3` | `Bibliotecólogo` | ✅ **(Special perms)**. Bibliotecólogo. |
| `4` | `Developer` | ✅ **(Admin (all) perms)**. Developer. | 


## Classes

| Class (directory) | Description    
| :-------- | :------- 
| `/classes/AuditLogs` | Returns information about users & admin actions in the website | 
| `/classes/Autores` | Returns information about all authors | 
| `/classes/Book` | Returns information about all books | 
| `/classes/Clubes` | Returns information about all authors | 
| `/classes/Database` | Establish the connection and setup the Database | 
| `/classes/Discord` | Returns information using the Discord API | 
| `/classes/IP` | Returns information about like the Country from the IP | 
| `/classes/Messages` | Used for error messages (login/credentials error) | 
| `/classes/Panel` | Returns some specific information about the panel (loaded on the Database) | 
| `/classes/Resenias` | Returns information about all reviews | 
| `/classes/Time` | Returns information about the Time (clock/hour) | 
| `/classes/User` | Returns all the neccesary information from the [SESSION] User| 
| `/classes/VPS` | Returns information about the server host | 

## Features

- **Encrypted passwords**
- Manage Books **(Exclusive for Admins)**
- Manage Users **(Exclusive for Admins)**
- Manage Authors **(Exclusive for Admins)**
- Audit Logs **(Exclusive for Admins)**
- Readers club
- See **your owned books** 
- **Customize** your profile
- **Responsive** and **beautifull** design
- 24/7 Database **backup & site config** at 9:00 a.m

## Site link (demo)

[Click para ver el sitio](https://sdbe.afagundez.shop/sign-in)
- **Click** on __"Entrar como visitante"__


## Setup files

Setup the Database.

```
1) Go to folder 'sql'
2) Open 'main-file.sql' and upload to your Database.

[*] - You can change the credentials at "website/classes/Database" and change credentials to the following:

private $servername = "localhost";
private $user = "root";
private $password = "";
private $dbname = "biblioteca";
```
## Authors

- [@aggus19 (Lead Developer)](https://github.com/aggus19)
- [@Rodrigo2407 (Database Admin)](https://github.com/Rodrigo2407)
- [@AlphaIndex (Platform Admin)](https://github.com/AlphaIndex)
- [@Facha (System Admin)](https://github.com/TinoTronado)



## Screenshots

![Login](https://i.imgur.com/TSssUIO.png)

![Profile](https://i.imgur.com/uc7mm8I.png)

![Books List](https://i.imgur.com/rg1O6ki.png)

![Readers Club](https://i.imgur.com/76mHbR1.png)

![About Us](https://i.imgur.com/ZBnGLnx.png)

![Audit Logs](https://i.imgur.com/zNcOawz.png)

![Logo](https://i.imgur.com/ivOXybD.png)

