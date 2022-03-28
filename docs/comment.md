# Коментарии
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
            api/comment/comment
        </td>
        <td>
            Получить коментарий
        </td>
    </tr>
     <tr>
        <td>
            api/comment/news-comments
        </td>
        <td>
            Получить коментарии к новости
        </td>
    </tr>
     <tr>
        <td>
            api/comment/create
        </td>
        <td>
            Создать коментарий (требует токен доступа)
        </td>
    </tr>
</table>

### Получение коментария

`http://dnrone.loc/api/comment/comment`
<p>
    Для получения коментария необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/comment/comment
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
            id коментария
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/comment/comment?comment_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "isSuccess": 200,
  "comment": {
    "id": 1,
    "comment_body": "fkjnvjdkfnvjkfcv",
    "like": 0,
    "dislike": 0,
    "username": "test"
  }
}
```

### Получение коментариев к новости

`http://dnrone.loc/api/comment/news-comments`
<p>
    Для получения коментариев к новости необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/comment/news-comments
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
            id новости
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/comment/news-comments?news_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "isSuccess": 200,
  "comment": [
    {
      "id": 1,
      "comment_body": "fkjnvjdkfnvjkfcv",
      "like": 0,
      "dislike": 0,
      "username": "test" // имя создателя коментария
    },
'...',
    {
      "id": 9,
      "comment_body": "jbjdhfbvjhfbvfcfvffvf",
      "like": null,
      "dislike": null,
      "username": "popo" // имя создателя коментария
    }
  ]
}
```

### Создание коментария

`http://dnrone.loc/api/comment/create`
<p>
    Требуется токен доступа. <br>Для создания коментария необходимо отправить <b>POST</b> запрос на URL http://dnrone.loc/api/comment/create
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
            id новости
        </td>
    </tr>
    <tr>
        <td>
            comment_body
        </td>
        <td>
            Тело коментария
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/comment/create`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "isSuccess": 200,
  "message": "Comment is createdl!",
  "comment": {
    "id": 11,
    "comment_body": "jbjdhfbvjhfbvfcfvffvf",
    "like": null,
    "dislike": null,
    "username": "popo"
  }
}
```

