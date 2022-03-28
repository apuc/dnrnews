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
            Получение новостей
        </td>
    </tr>
</table>

### Получение категорий

`http://dnrone.loc/api/news/news`
<p>
    Для получения списка категорий необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/category/category
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
            news_id
        </td>
        <td>
            При передачи id новости будет возвращено значение одной новости
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
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/news/news?expand=comments,tags`

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
      "photo": "pppp11111",
      "news_body": "11111111111111",
      "like": 0,
      "dislike": 0,
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
        {
          "id": 4,
          "comment_body": "fkjnvjdkfnvjkfcv",
          "like": 0,
          "dislike": 0,
          "username": "test"
        },
        {
          "id": 5,
          "comment_body": "fkjnvjdkfnvjkfcv",
          "like": 0,
          "dislike": 0,
          "username": "test"
        },
        {
          "id": 6,
          "comment_body": "jbjdhfbvjhfbvfcfvf",
          "like": null,
          "dislike": null,
          "username": "popo"
        },
        {
          "id": 7,
          "comment_body": "jbjdhfbvjhfbvfcfvffvf",
          "like": null,
          "dislike": null,
          "username": "popo"
        },
        {
          "id": 8,
          "comment_body": "jbjdhfbvjhfbvfcfvffvf",
          "like": null,
          "dislike": null,
          "username": "popo"
        },
        {
          "id": 9,
          "comment_body": "jbjdhfbvjhfbvfcfvffvf",
          "like": null,
          "dislike": null,
          "username": "popo"
        }
      ],
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=comments&news_id=1"
        }
      }
    },
   ' ...',

    {
      "id": 18,
      "title": "fgfbgf",
      "photo": "fbgcbgc",
      "news_body": "fbfbgcv",
      "like": null,
      "dislike": null,
      "tags": [],
      "comments": [],
      "_links": {
        "self": {
          "href": "http://dnrone.loc/api/news/news?expand=comments&news_id=18"
        }
      }
    }
  ]
}
```
