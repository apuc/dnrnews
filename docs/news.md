# Новости

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
            api/news/news
        </td>
        <td>
            Получение новости
        </td>
    </tr>
    <tr>
        <td>
            api/news/news-list
        </td>
        <td>
            Получение списка новостей
        </td>
    </tr>
    <tr>
        <td>
            api/news/find
        </td>
        <td>
            Поиск новостей
        </td>
    </tr>
</table>

### Получение новости

`http://dnrone.loc/api/news/news`
<p>
    Для получения новости необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/news/news
</p>
<p>
    Параметры параметры:
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
            Обязателен
        </th>
    </tr>
    <tr>
        <td>
            news_id
        </td>
        <td>
            Id новости
        </td>
        <td>
            Да
        </td>
    </tr>
    <tr>
        <td>
            expand=tags, comments, comments_count news_body, like, photo, category
        </td>
        <td>
             Добавляет к данным: категорий; данные закреплённых за ней тегов; коментариев; количество комментариев;
            тело новости; лайки; ссылку на фото новости; данные категории
        </td>
        <td>
            Нет
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "News",
  "data": {
    "id": 3,
    "title": "000000003333333",
    "tags": [
      {
        "id": 5,
        "title": "tag1"
      },
      {
        "id": 6,
        "title": "tag2"
      }
    ],
    "comments": [
      {
        "id": 3,
        "comment_body": "fkjnvjdkfnvjkfcv",
        "username": "popo"
      },    
      '...',
      {
        "id": 84,
        "comment_body": "fkjnvjdkfnvjkfcv",
        "username": "popo"
      }
    ],
    "photo": "pppppp33333333",
    "news_body": "333333333333333333",
    "like": "0",
    "category": [
      {
        "id": 1,
        "title": "category1"
      }
    ],
    "_links": {
      "self": {
        "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=3"
      }
    }
  }
}
```

### Получение списка новостей

`http://dnrone.loc/api/news/news-list`
<p>
    Для получения списка новостей необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/news/news-list
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
            category_id[] (массив)
        </td>
        <td>
            При указании массива id категорий, возвращает список новостей с задаными категориями
        </td>
    </tr>
    <tr>
        <td>
            tag_id[] (массив)
        </td>
        <td>
            При указании массива id тегов, возвращает список новостей с задаными тегами
        </td>
    </tr>
    <tr>
        <td>
            expand=tags, comments, comments_count, news_body, like, photo, category
        </td>
        <td>
             Добавляет к данным: категории; данные закреплённых за ней тегов; коментарии; количество комментариев;
            тело новости; лайки; ссылку на фото новости
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/news/news-list?category_id=1&tags_id[0]=5&tags_id[1]=5&tags_id[2]=3`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "News list.",
  "data": [
    {
      "id": 1,
      "title": "fdgdrgbfd",
      "photo": "pppp11111",
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=1"
        }
      }
    },
    {
      "id": 2,
      "title": "dfgvfdbf",
      "photo": "ppppp22222222",
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=2"
        }
      }
    },
    {
      "id": 3,
      "title": "fdgdfg",
      "photo": "pppppp33333333",
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=3"
        }
      }
    }
  ]
}
```

### Поиск новостей

`http://dnrone.loc/api/news/аштв`
<p>
    Для поиска новостей необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/news/find
    При передаче запроса без параметров title и text будет возвращен список всех новостей.
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
            title
        </td>
        <td>
            Текст для поиска по заголовкам статей
        </td>
    </tr>
    <tr>
        <td>
            text
        </td>
        <td>
            Текст для поиска по телу новостей
        </td>
    </tr>
    <tr>
        <td>
            expand=tags, comments, comments_count, news_body, like, photo, category
        </td>
        <td>
             Добавляет к данным: категории; данные закреплённых за ней тегов; коментарии; количество комментариев;
            тело новости; лайки; ссылку на фото новости
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/news/find?title=as&text=4444&expand=tags,comments,photo,news_body,like,category`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "News list",
  "data": [
    {
      "id": 12,
      "title": "asdd",
      "tags": [],
      "comments": [],
      "photo": "pppp444444",
      "news_body": "444444444444444 3456789hgvcxcv",
      "like": "0",
      "category": [],
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=12"
        }
      }
    },
    {
      "id": 14,
      "title": "assxv",
      "tags": [],
      "comments": [],
      "photo": "pppp444444",
      "news_body": "444444444444444 dfghjbk",
      "like": "0",
      "category": [],
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=14"
        }
      }
    }
  ]
}
```

