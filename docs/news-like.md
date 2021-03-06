# Лайки новостей

## Методы

<p>
    Для использования методов тербуется токен доступа
</p>   

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
            api/user-news-like/set-like
        </td>
        <td>
            Поставить новости лайк
        </td>
    </tr>
    <tr>
        <td>
            api/user-news-like/set-like
        </td>
        <td>
            Удалить лайк у новости
        </td>
    </tr>
    <tr>
        <td>
            api/user-news-like/check-news-like
        </td>
        <td>
            Проверка выставления лайка данным пользователем
        </td>
    </tr>
</table>

### Поствать новости лайк

`http://dnrone.loc/api/user-news-like/set-like`
<p>
    Для добавления новости лайка необходимо отправить <b>POST</b> запрос на URL http://dnrone.loc/api/user-news-like/set-like
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
            news_id
        </td>
        <td>
            Id новости
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/user-news-like/set-like`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Like was created!",
  "data": {
    "news_id": "10",
    "user_id": 21,
    "id": 16
  }
}
```

### Удаление лайка у новостей

`http://dnrone.loc/api/user-news-like/delete-like`
<p>
    Для удаления лайка новости необходимо отправить <b>DELETE</b> запрос на URL http://dnrone.loc/api/user-news-like/delete-like
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
            news_id
        </td>
        <td>
            Id новости
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/user-news-like/delete-like?news_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Like is deleted!",
  "data": {
    "id": 16,
    "user_id": 21,
    "news_id": 10
  }
}
```

### Проверка выставления лайка данным пользователем

`http://dnrone.loc/api/user-news-like/check-news-like`
<p>
    Для выполнения проверки необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/user-news-like/check-news-like
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
            news_id
        </td>
        <td>
            Id новости
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/user-news-like/check-news-like?news_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Like is already existing.",
  "data": {
    "id": 17,
    "user_id": 21,
    "news_id": 1
  }
}
```
