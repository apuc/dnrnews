# Цвета

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
            api/color/get-colors/
        </td>
        <td>
            Получить цвета 
        </td>
    </tr>
     <tr>
        <td>
            api/color/set-color/
        </td>
        <td>
            Сохранить цвет
        </td>
    </tr>
    <tr>
        <td>
            api/color/set-colors/
        </td>
        <td>
            Перезапись массива цветов
        </td>
    </tr>
</table>

### Получить цвета

`http://dnrnews.loc/api/color/get-colors/`
<p>
    Для получения массива цветов необходимо отправить <b>GET</b> запрос на URL http://dnrnews.loc/api/color/get-colors/
</p>

<p>
    Пример запроса:
</p>

`http://dnrnews.loc/api/color/get-colors/`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Colors list!",
  "data": [
    {
      "id": 1,
      "value": "dfdvfbfgb",
      "name": null
    },
    '...',
    {
      "id": 5,
      "value": "#d887000",
      "name": "yyy888"
    }
  ]
}
```

### Сохранить цвет

`http://dnrnews.loc/api/color/set-color/`
<p>
    Для создания цвета необходимо отправить <b>POST</b> запрос на URL http://dnrnews.loc/api/color/set-color/
    <br> При передаче параметра id данные существующего цвета будут перезаписанны.
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
            id
        </td>
        <td>
            Id цвета
        </td>
        <td>
            Нет
        </td>
    </tr>
    <tr>
        <td>
            value
        </td>
        <td>
            Значение цвета
        </td>
        <td>
            Да
        </td>
    </tr>
    <tr>
        <td>
           name
        </td>
        <td>
            Имя цвета
        </td>
        <td>
            Нет
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://dnrnews.loc/api/color/set-color/`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Color is saved!",
  "data": {
    "id": 7,
    "value": "#d887000",
    "name": "yyy888"
  }
}
```

### Сохранить массив цветов

`http://dnrnews.loc/api/color/set-colorы/`
<p>
    Для сохранения/перезаписи массива цветов необходимо отправить <b>POST</b>
    запрос на URL http://dnrnews.loc/api/color/set-colors/ c json-м цветов в теле.
    <br> При передаче пустого параметра id будет сохранён новый цвет. Цвета, которых не будет 
    в массиве на сохранение будут удалены.

</p>
<p>
    Пример ожидаемого json:
</p>

```json5
{
    "colors" : [
         {
            "id": null,
            "value": "ppppppppp",
            "name": "999999"
        },
        {
            "id": 2,
            "value": "#d887000",
            "name": "yyy888"
        },
        {
            "id": 3,
            "value": "#00000000",
            "name": null
        },
        {
            "id": 4,
            "value": "#d887000",
            "name": "88888888888888"
        }
    ]
}
```

<p>
    Пример запроса:
</p>

`http://dnrnews.loc/api/color/set-colors/`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Colors saved!",
  "data": [
    {
      "id": 1,
      "value": "dfdvfbfgb",
      "name": null
    },
    '...',
    {
      "id": 10,
      "value": "dfdvfbfgb",
      "name": null
    },
    {
      "id": 11,
      "value": "ppppppppp",
      "name": "999999"
    },
    {
      "id": 12,
      "value": "ttttttttttttttttt",
      "name": "999999"
    }
  ]
}
```
