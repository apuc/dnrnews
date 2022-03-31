# Дислайки коментариев

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
            api/user-comment-dislike/comment-set-dislike
        </td>
        <td>
            Поставить комментарию дислайк
        </td>
    </tr>
    <tr>
        <td>
            api/user-comment-dislike/comment-delete-dislike
        </td>
        <td>
            Удалить дислайк коментария
        </td>
    </tr>
</table>

### Поствать комментарию дислайк

`http://dnrone.loc/api/user-comment-dislike/comment-delete-dislike`
<p>
    Для добавления комментарию лайка необходимо отправить <b>POST</b> запрос на URL http://dnrone.loc/api/user-comment-dislike/comment-delete-dislike
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

`http://dnrone.loc/api/user-comment-dislike/comment-delete-dislike?comment_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "isSuccess": 200,
  "message": "Like is created!",
  "user_news_like": {
    "id": 5,
    "user_id": 21,
    "comment_id": 1
  }
}
```

### Удаление дислайка коментария

`http://dnrone.loc/api/user-comment-dislike/comment-delete-dislike`
<p>
    Для удаления дислайка у коментария необходимо отправить <b>DELETE</b> запрос на URL http://dnrone.loc/api/user-comment-dislike/comment-delete-dislike
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

`http://dnrone.loc/api/user-comment-dislike/comment-delete-dislike?comment_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "isSuccess": 200,
  "message": "Like is deleted!",
  "user_news_like": {
    "id": 5,
    "user_id": 21,
    "comment_id": 1
  }
}
```
