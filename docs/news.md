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
    <tr>
        <td>
            api/news/filter
        </td>
        <td>
            Фильтрация новостей
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
  "news": [
    {
      "id": 3,
      "title": "000000003333333",
      "published_date": 1648312837,
      "views": 9,
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=3"
        }
      }
    },
    {
      "id": 10,
      "title": "bb",
      "published_date": 1648360000,
      "views": 0,
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=10"
        }
      }
    }
  ],
  "_links": {
    "self": {
      "href": "http://dnrone.loc/api/news/news-list?tags_id%5B0%5D=5&tags_id%5B1%5D=7&tags_id%5B2%5D=4&page=1"
    },
    "first": {
      "href": "http://dnrone.loc/api/news/news-list?tags_id%5B0%5D=5&tags_id%5B1%5D=7&tags_id%5B2%5D=4&page=1"
    },
    "last": {
      "href": "http://dnrone.loc/api/news/news-list?tags_id%5B0%5D=5&tags_id%5B1%5D=7&tags_id%5B2%5D=4&page=1"
    }
  },
  "_meta": {
    "totalCount": 2,
    "pageCount": 1,
    "currentPage": 1,
    "perPage": 20
  }
}
```

### Поиск новостей

`http://dnrone.loc/api/news/find`
<p>
    Для поиска новостей необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/news/find
    При передаче запроса без параметра text будет возвращен список всех новостей.
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
            text
        </td>
        <td>
            Текст поиска по заголовкам и телу новостей
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

`http://dnrone.loc/api/news/find?text=555&expand=tags,comments,photo,news_body,like,category`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "news": [
    {
      "id": 79,
      "title": "новость5555",
      "published_date": 1651672584,
      "views": 0,
      "tags": [],
      "comments": [],
      "photo": "/uploads/news-image/a5caa980cd8b0b84c56ffd2f4b6e3ea5.png",
      "news_body": "рполь новость",
      "like": 0,
      "category": [],
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=79"
        }
      }
    }
  ],
  "_links": {
    "self": {
      "href": "http://dnrone.loc/api/news/find?text=555&expand=tags%2Ccomments%2Cphoto%2Cnews_body%2Clike%2Ccategory&page=1"
    },
    "first": {
      "href": "http://dnrone.loc/api/news/find?text=555&expand=tags%2Ccomments%2Cphoto%2Cnews_body%2Clike%2Ccategory&page=1"
    },
    "last": {
      "href": "http://dnrone.loc/api/news/find?text=555&expand=tags%2Ccomments%2Cphoto%2Cnews_body%2Clike%2Ccategory&page=1"
    }
  },
  "_meta": {
    "totalCount": 1,
    "pageCount": 1,
    "currentPage": 1,
    "perPage": 20
  }
}
```

### Фильтр новостей

`http://dnrone.loc/api/news/filter`
<p>
    Для фильтрации новостей отправить <b>GET</b> запрос на URL http://dnrone.loc/api/news/filter
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
            category(массив)
        </td>
        <td>
            Массив категорий новости
        </td>
    </tr>
    <tr>
        <td>
            tags(массив)
        </td>
        <td>
            Массив тегов новости
        </td>
    </tr>
    <tr>
        <td>
            published
        </td>
        <td>
            Дата публикации
        </td>
    </tr>
    <tr>
        <td>
            from_date
        </td>
        <td>
            Начальная дата периода поиска
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

`http://dnrone.loc/api/news/filter?published=1651672484&from_date=1651672384&category[0]=28&tags[0]=5&tags[1]=6`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "news": [
    {
      "id": 82,
      "title": "новость",
      "published_date": 1651672474,
      "views": 0,
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=82"
        }
      }
    },
    {
      "id": 83,
      "title": "новость",
      "published_date": 1651672484,
      "views": 0,
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=83"
        }
      }
    }
  ],
  "_links": {
    "self": {
      "href": "http://dnrone.loc/api/news/filter?published=1651672484&from_date=1651672384&page=1"
    },
    "first": {
      "href": "http://dnrone.loc/api/news/filter?published=1651672484&from_date=1651672384&page=1"
    },
    "last": {
      "href": "http://dnrone.loc/api/news/filter?published=1651672484&from_date=1651672384&page=1"
    }
  },
  "_meta": {
    "totalCount": 2,
    "pageCount": 1,
    "currentPage": 1,
    "perPage": 20
  }
}
```