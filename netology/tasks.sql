UPDATE netology.tasks SET user_id = 1, assigned_user_id = 2, description = 'Опубликовать статью', is_done = 0, date_added = '2018-06-07 11:41:26' WHERE id = 1;
UPDATE netology.tasks SET user_id = 1, assigned_user_id = 2, description = 'Проверить орфографию', is_done = 0, date_added = '2018-06-07 11:41:32' WHERE id = 2;
UPDATE netology.tasks SET user_id = 1, assigned_user_id = 1, description = 'Подобрать фото на стоках', is_done = 1, date_added = '2018-06-07 11:41:37' WHERE id = 3;
UPDATE netology.user SET login = 'Konstantin', password = 'qwerty' WHERE id = 1;
UPDATE netology.user SET login = 'Olga', password = '123' WHERE id = 2;