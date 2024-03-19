# Тестовое задание для стажировки Вконтакте, программист-разработчик

Задание выполнял на чистом php, использовал сервер apache2, поэтому расскажу как его настроить для работы с API. Выполните следующие шаги для запуска API:

1. Перейдите в директорию:
   
   cd /var/www/html

2. Склонируйте репозиторий:

   sudo git clone https://github.com/TABbl/Test_vk 

   (Если не получается склонировать репозиторий из-за прав доступа, то попробуйте изменить их, выполнив команду:

   sudo chmod 777 /var/www/html 


3. Для восстановления базы данных из дампа, который находится в проекте, выполните:

   mysql -u username -p test_for_vk < database_dump.sql


4. Необходимо внести следующее в файл apache2.conf:

   <Directory /var/www/html>
   AllowOverride All
   </Directory>


   Для этого можно использовать команду:

   sudo nano etc/apache2/apache2.conf


   Это необходимо для корректной работы перенаправления при обращении к разным URI API.

5. Также необходимо выполнить:

   sudo a2enmod rewrite

   и затем:

   sudo systemctl reload apache2


   Если apache2 не запущен, то выполните:

   sudo systemctl start apache2


   Если сервер не запускается, то удостоверьтесь, что 80 порт не занят никаким другим процессом:

   sudo netstat -tuln | grep :80


В Postman:

- Для создания пользователя требуется отправить POST запрос http://localhost/api.testvk.ru/users. В теле запроса в form-data должны быть поля 'name', 'password' с соответствующими значениями.

- Для создания задания отправьте POST запрос http://localhost/api.testvk.ru/quests. В теле запроса в form-data должны быть поля 'name', 'body', 'cost' с соответствующими значениями.

- Для получения истории выполненных пользователем({id}) заданий отправьте GET запрос http://localhost/api.testvk.ru/users/{id}/quests, где вместо {id} должно быть id желаемого пользователя.

- Для засчитывания пользователю задания({q_id}) отправьте POST запрос http://localhost/api.testvk.ru/quests/{q_id}/complete. В теле запроса в form-data должно быть поле user_id с значение id пользователя, которому вы хотите засчитать задание.