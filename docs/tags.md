# Теги

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
            api/tag/tag
        </td>
        <td>
            Получение тегов
        </td>
    </tr>
</table>

### Получение тегов

`http://dnrone.loc/api/category/category`
<p>
    Для получения списка тегов необходимо отправить <b>GET</b> запрос на URL http://dnrone.loc/api/tag/tag
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
            tag_id
        </td>
        <td>
            При передачи id тега будут возвращены данные одного тега.
            Без этого параметра метод возвращает данные всех тегов.
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrone.loc/api/tag/tag?tag_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Tag list.",
  "data": [
    {
      "id": 5,
      "title": "tag1"
    },
    {
      "id": 6,
      "title": "tag2"
    },
    {
      "id": 7,
      "title": "tag3"
    },
    {
      "id": 9,
      "title": "tag3"
    }
  ]
}
```
