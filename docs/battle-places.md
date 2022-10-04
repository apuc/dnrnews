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
      "name": "Мариуполь",
      "bounds": "[[47.068955, 37.366551], [47.221192, 37.743027]]"
    }
  ]
}
```
