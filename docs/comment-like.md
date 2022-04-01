# Лайки коментариев

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
            api/user-comment-like/comment-set-like
        </td>
        <td>
            Поставить комментарию лайк
        </td>
    </tr>
    <tr>
        <td>
            api/user-comment-like/comment-delete-like
        </td>
        <td>
            Удалить лайк коментария
        </td>
    </tr>
</table>

### Поствать комметнтариюлайк

`http://dnrone.loc/api/user-comment-like/comment-set-like`
<p>
    Для добавления комментарию лайка необходимо отправить <b>POST</b> запрос на URL http://dnrone.loc/api/user-comment-like/comment-set-like
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
            comment_id
        </td>
        <td>
            Id коментария
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/user-comment-like/comment-set-like`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Like is created!",
  "data": {
    "id": 19,
    "user_id": 21,
    "comment_id": 1
  }
}
```

### Удаление лайка коментария

`http://dnrone.loc/api/user-comment-like/comment-delete-like`
<p>
    Для удаления лайка у коментария необходимо отправить <b>DELETE</b> запрос на URL http://dnrone.loc/api/user-comment-like/comment-delete-like
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
            comment_id
        </td>
        <td>
            Id комментария
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/user-comment-like/comment-delete-like?comment_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Like is deleted!",
  "data": {
    "id": 19,
    "user_id": 21,
    "comment_id": 1
  }
}
```
