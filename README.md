<p>
    1) Миграция для создания пользователя с правами администратора: <br>
    php yii migrate --migrationPath=@andrewdanilov/adminpanel/migrations
</p>
<p>
    2) Создать папки для картинок: <br>
        sudo mkdir -p frontend/web/uploads/news-image <br>
        sudo mkdir -p frontend/web/uploads/battle_place_photo
    3) Задать права папкам
    4) Создать символьные ссылки для фото из бэкенда во фронтенд <br>
        cd backend/web
        ln -s ../../frontend/web/uploads/news-image/ photo
        ln -s ../../frontend/web/uploads/battle_place_photo battle_place_photo

</p>
