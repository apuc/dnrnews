# Bounds

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
            api/battle-place/get-battle-places
        </td>
        <td>
            Получить список
        </td>
</table>

### Получить цвета

`http://dnrnews.loc/api/battle-place/get-battle-places`
<p>
    Для получения списка bounds необходимо отправить <b>GET</b> запрос на URL http://battlemap.loc/api/bounds/get-bounds
</p>

<p>
    Пример запроса:
</p>

`http://dnrnews.loc/api/battle-place/get-battle-places`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "List of battle places",
  "data": [
    {
      "id": 2,
      "name": "Мариуполь",
      "bounds": "[[47.068955, 37.366551], [47.221192, 37.743027]]",
      "scale": null,
      "start_date": null,
      "end_date": null,
      "photo": "/uploads/battle_place_photo/4af7655acd864975915885ed2a4fa5b9.jpg",
      "description": "test"
    },
    {
      "id": 3, 
      "name": "ddfcds",
      "bounds": "fvdfv",
      "scale": 20,
      "start_date": "2022-11-30 00:00:00",
      "end_date": "2022-12-01 00:00:00",
      "photo": "N/A",
      "description": "test"
    }
  ]
}
```
