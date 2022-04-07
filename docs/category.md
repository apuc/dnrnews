# Категории

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
            api/category/category
        </td>
        <td>
            Получение категорий
        </td>
    </tr>
</table>

### Получение категорий

`http://dnrone.loc/api/category/category`
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
            category_id
        </td>
        <td>
            При передачи id категории будут возвращены данные одной категории.
            Без этого параметра метод возвращает данные всех категорий
        </td>
    </tr>
    <tr>
        <td>
            expand=tags
        </td>
        <td>
             Добавляет к данным категории данные закреплённых за ней тегов
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/category/category?expand=tags`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Category list.",
  "data": [
    {
      "id": 1,
      "title": "category1",
      "tags": [
        {
          "id": 5,
          "title": "tag1"
        },
        {
          "id": 6,
          "title": "tag2"
        }
      ]
    },
    {
      "id": 2,
      "title": "category2",
      "tags": [
        {
          "id": 7,
          "title": "tag3"
        }
      ]
    },
    {
      "id": 3,
      "title": "category3",
      "tags": []
    },
    {
      "id": 4,
      "title": "category4",
      "tags": []
    }
  ]
}
```
