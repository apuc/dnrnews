# Иконки событий

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
            api/event-type/get-event-types
        </td>
        <td>
            Получение иконок событий
        </td>
    </tr>
</table>

### Получение иконок

`http://dnrnews.loc/api/event-type/get-event-types`
<p>
    Для получения списка иконок необходимо отправить <b>GET</b> запрос на URL http://dnrnews.loc/api/event-type/get-event-types
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
            event_type_id
        </td>
        <td>
            При передачи id иконки будут возвращены данные одной иконки.
            Без этого параметра метод возвращает данные всех иконок.
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrnews.loc/api/event-type/get-event-types?event_type_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Event type list.",
  "data": [
    {
      "id": 1,
      "title": "Dot",
      "icon": "/uploads/news-image/icon/aac1c97b2e75943882f72f85cbf3e9cc.png",
      "status": 10
    }
  ]
}
```
