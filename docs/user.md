# Пользователь

## Методы

<table>
    <tr>
        <th>
            Метод
        </th>
        <th>
            Описание
        </th>
    </tr>
    <tr>
        <td>
            api/user/create
        </td>
        <td>
            Регистрация
        </td>
    </tr>
    <tr>
        <td>
            api/user/login
        </td>
        <td>
            Авторизация
        </td>
    </tr>
</table>

### Регистрация

`http://dnrone.loc/api/user/create`
<p>
    Для регистрации нового пользователя необходимо отправить <b>POST</b> запрос на URL http://dnrone.loc/api/user/create
</p>
<p>
    Требуемые параметры параметры:
</p>
<table>
    <tr>
        <th>
            Параметры
        </th>
        <th>
            Значение
        </th>
    </tr>
    <tr>
        <td>
            username
        </td>
        <td>
            Имя пользователя
        </td>
    </tr>
    <tr>
        <td>
            email
        </td>
        <td>
            Почта  
        </td>
    </tr>
    <tr>
        <td>
            password
        </td>
        <td>
            Пароль 
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/user/create`

<p>
    Возвращает объект <b>Пользователь</b>. <br>
    Каждый объект <b>Пользователь</b> имеет такой вид:
</p>

```json5
{
  "message": "You are now a member!",
  "data": {
    "id": 27,
    "username": "refUserjj",
    "email": "refUserjj@mfdf.com",
    "access_token": "EoGbCuRMSXx57koj_5MpHDwUSoH2eKSD",
    "access_token_expired_at": "2022-04-08 00:00:00"
  }
}
```

### Авторизация

`http://dnrone.loc/api/user/login`

<p>
    Для того, чтобы получить данные авторизвции необходимо отправить <b>GET</b> запрос
    на URL http://dnrone.loc/api/user/login.
</p>
<p> 
    Пример запроса:
</p>

`http://dnrone.loc/api/user/login?username=popo&password=fdbh6473gsd6w7`

<p>
    Возвращает объект <b>Профиля</b> и токен доступа с датой окончания действия токена.
</p>
<p>
    Требуемые параметры:
</p>
<table>
    <tr>
        <th>
            Параметры
        </th>
        <th>
            Значение
        </th>
    </tr>
    <tr>
        <td>
            username
        </td>
        <td>
            Имя пользователя
        </td>
    </tr>
     <tr>
        <td>
            password
        </td>
        <td>
            Пароль
        </td>
    </tr>
</table>

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Authorization is successful!",
  "data": {
    "id": 27,
    "username": "refUserjj",
    "email": "refUserjj@mfdf.com",
    "access_token": "ubhFvO092ry9d-ZC3w9E55wpYFVDK3cz",
    "access_token_expired_at": "2022-04-08 00:00:00"
  }
}
```
