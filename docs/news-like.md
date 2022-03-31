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
  "isSuccess": 200,
  "message": "Like is created!",
  "user_news_like": {
    "user_id": 21,
    "news_id": "1",
    "id": 13
  }
}
```

### Получение списка новостей

`http://dnrone.loc/api/user-news-like/delete-like`
<p>
    Для получения списка новостей необходимо отправить <b>DELETE</b> запрос на URL http://dnrone.loc/api/user-news-like/delete-like
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
  "isSuccess": 200,
  "message": "Like is deleted!",
  "user_news_like": {
    "id": 13,
    "user_id": 21,
    "news_id": 1
  }
}
```
