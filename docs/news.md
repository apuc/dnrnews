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
</table>

### Получение новости

`http://dnrone.loc/api/news/news`
<p>
    Для получения списка категорий необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/news/news
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
            При передачи id новости будет возвращено значение одной новости
        </td>
    </tr>
    <tr>
        <td>
            expand=tags, comments, photo, news_body, like
        </td>
        <td>
             Добавляет к данным: категории; данные закреплённых за ней тегов; коментарии; 
            тело новости; лайки; ссылку на фото новости
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
  "isSuccess": 200,
  "news": {
    "id": 1,
    "title": "fdgdrgbfd",
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
        "id": 1,
        "comment_body": "fkjnvjdkfnvjkfcv",
        "like": 0,
        "dislike": 0,
        "username": "test"
      },
      '...',
      {
        "id": 21,
        "comment_body": "jbjdhfbvjhfbvfcfvffvf",
        "like": 0,
        "dislike": 0,
        "username": "popo"
      }
    ],
    "photo": "pppp11111",
    "news_body": "11111111111111",
    "like": 0,
    "_links": {
      "self": {
        "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=1"
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
            category_id
        </td>
        <td>
            Возвращает список новостей данной категории
        </td>
    </tr>
    <tr>
        <td>
            tag_id[] (массив)
        </td>
        <td>
            При указании массива id тегов, возвращает список категорий с задаными тегами
        </td>
    </tr>
    <tr>
        <td>
            expand=comments,tags
        </td>
        <td>
             Добавляет к данным категории данные закреплённых за ней тегов и коментариев
        </td>
    </tr>
    <tr>
        <td>
            expand=tags, comments, photo, news_body, like
        </td>
        <td>
             Добавляет к данным: категории; данные закреплённых за ней тегов; коментарии; 
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
  "isSuccess": 200,
  "news": [
    {
      "id": 1,
      "title": "fdgdrgbfd",
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=1"
        }
      }
    },
    {
      "id": 3,
      "title": "fdgdfg",
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=tags,comments,photo,news_body,like&news_id=3"
        }
      }
    }
  ]
}
```
