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
    <tr>
        <td>
            api/comment/delete
        </td>
        <td>
            Удалить коментарий (требует токен доступа)
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
        <th>
            Требуется
        </th>
    </tr>
    <tr>
        <td>
            comment_id
        </td>
        <td>
            id коментария
        </td>
        <td>
            Да
        </td>
    </tr>
    <tr>
        <td>
            expand=like, dislike
        </td>
        <td>
             Добавляет к данным количество: лайков; дислайков;
        </td>
        <td>
            Нет
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
  "message": "One comment.",
  "data": {
    "id": 2,
    "comment_body": "fkjnvjdkfnvjkfcv",
    "username": "ghhgccfg",
    "dislike": "3",
    "like": "6"
  }
}
```

### Получение коментариев к новости

`http://dnrone.loc/api/comment/news-comments`
<p>
    Для получения коментариев к новости необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/comment/news-comments
    При передачи токена аутификации будут возвращены флаги лайков и дислайков для данного пользователя. Без токена флаги будут иметь нулевые значения.
</p>
<p>
    Параметры:
</p>
<table>
    <tr>
        <th>
            Параметры
        </th>
        <th>
            Значение
        </th>
        <th>
            Требуется
        </th>
    </tr>
    <tr>
        <td>
            news_id
        </td>
        <td>
            id новости
        </td>
        <th>
            Да
        </th>
    </tr>
    <tr>
        <td>
            expand=like, dislike,user_like, user_dislike
        </td>
        <td>
             Добавляет к данным количество лайков и дислайков, флаги выставлен пользователем лайк и дислайк
        </td>
        <th>
            Нет
        </th>
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
  "comments": [
    {
      "id": 2,
      "comment_body": "fkjnvjdkfnvjkfcv",
      "username": "refUserjj",
      "dislike": 2,
      "like": 6,
      "user_like": null,
      "user_dislike": null
    },
    '...',
    {
      "id": 42,
      "comment_body": "jbjdhfbvjhfbvfcfvffvf",
      "username": "refUserjj",
      "dislike": 0,
      "like": 0,
      "user_like": null,
      "user_dislike": null
    }
  ],
  "_links": {
    "self": {
      "href": "http://dnrone.loc/api/comment/news-comments?news_id=2&expand=like%2C+dislike%2Cuser_like%2C+user_dislike&user_id=27&page=1"
    },
    "first": {
      "href": "http://dnrone.loc/api/comment/news-comments?news_id=2&expand=like%2C+dislike%2Cuser_like%2C+user_dislike&user_id=27&page=1"
    },
    "last": {
      "href": "http://dnrone.loc/api/comment/news-comments?news_id=2&expand=like%2C+dislike%2Cuser_like%2C+user_dislike&user_id=27&page=4"
    },
    "next": {
      "href": "http://dnrone.loc/api/comment/news-comments?news_id=2&expand=like%2C+dislike%2Cuser_like%2C+user_dislike&user_id=27&page=2"
    }
  },
  "_meta": {
    "totalCount": 64,
    "pageCount": 4,
    "currentPage": 1,
    "perPage": 20
  }
}
```

### Создание коментария

`http://dnrone.loc/api/comment/create`
<p>
    Требуется токен доступа. <br>Для создания коментария необходимо отправить <b>POST</b> запрос на URL http://dnrone.loc/api/comment/create
</p>
<p>
    Параметры:
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
  "message": "Comment is created!",
  "data": {
    "id": 26,
    "comment_body": "jbjdhfbvjhfbvfcfvffvf",
    "username": "popo"
  }
}
```

### Удаление коментария

`http://dnrone.loc/api/comment/delete`
<p>
    Требуется токен доступа. <br>Для удаления коментария необходимо отправить <b>DELETE</b> запрос на URL http://dnrone.loc/api/comment/delete
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

`http://dnrone.loc/api/comment/delete?comment_id=26`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Comment was deleted!",
  "data": {
    "id": 26,
    "comment_body": "jbjdhfbvjhfbvfcfvffvf",
    "username": "popo"
  }
}
```

