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
    Возможные параметры:
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
  "isSuccess": 201,
  "message": "You are now a member!",
  "user": {
    "id": 22,
    "username": "popo1",
    "email": "tetfffd1v@mfdf.com",
    "access_token": "iqP32bwyBSJugVTa5xL0DIphPS6swlwL",
    "access_token_expired_at": "2022-04-04 00:00:00"
  }
}
```

###Авторизация

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
  "isSuccess": 200,
  "message": "Authorization is successful!",
  "user": {
    "id": 21,
    "username": "popo",
    "email": "tetfffdv@mfdf.com",
    "access_token": "HcxB8_XEkPevr-B3i-rb5Y1uxGawgCI7",
    "access_token_expired_at": "2022-04-04 00:00:00"
  }
}
```
