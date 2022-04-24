<p>
    1) Миграция для создания пользователя с правами администратора: <br>
    php yii migrate --migrationPath=@andrewdanilov/adminpanel/migrations
</p>
<p>
    2) Создать папку для картинок новостей: <br>
        sudo mkdir -p frontend/web/uploads/news-image
    3) Задать права папке
    4) Создать символьную ссылку для фото из бэкенда во фронтенд <br>
        cd backend/web
        ln -s ../../frontend/web/uploads/news-image/ photo

</p>
