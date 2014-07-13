Описание функционала серверной части.

Выполнено с использованием laravel framework http://laravel.com/


## АДМИНИСТРИРОВАНИЕ

Только авторизованные пользователи могут обращаться к /admin

Для авторизации служит путь /login (login.get [get]).

Для отправки параметров авторизации путь /login (login.post [post]).

Для выхода из своей учетной записи /logout (logout [get]).

За авторизацию и аутентификацию отвечает SecurityController.


### АДМИНИСТРИРОВАНИЕ ПОЛЬЗОВАТЕЛЕЙ

Путь | Название | Метод | Описание
-----|----------|-------|---------
admin/users | users.index | get | Вывести список пользователей
admin/users/create | users.create | get | Вывод формы нового пользователя
admin/users | users.store | post | Сохранение нового пользователя
admin/users/{id} | users.show | get | Вывод одного пользователя
admin/users/{id}/edit | users.edit | get | Вывод формы редактирования
admin/users/{id} | users.update | put | Сохранение изменений
admin/users/{id} | users.destroy | delete | Удаление пользователя

На указанные выше операции накладываются следующие ограничения:

1. Нельзя создать двух пользователей с одним email

2. Нельзя заблокировать всех пользователей, всегда должен остаться как минимум один пользователь способный зайти в систему

3. Пароль не может быть короче 5 символов

За администрирование пользователей отвечает UserController

Все страницы находятся в папке views/admin/

Шаблон layout.users


### АДМИНИСТРИРОВАНИЕ ОТДЕЛОВ

Путь | Название | Метод | Описание
-----|----------|-------|---------
admin/departments | departments.index | get | Вывести список отделов
admin/departments/create | departments.create | get | Вывод формы нового отдела
admin/departments | departments.store | post | Сохранение нового отдела
admin/departments/{id} | departments.show | get | Вывод одного отдела
admin/departments/{id}/edit | departments.edit | get | Вывод формы редактирования
admin/departments/{id} | departments.update | put | Сохранение изменений
admin/departments/{id} | departments.destroy | delete | Удаление отдела

Имена отделов должны быть уникальны.

За администрирование отделов отвечает DepartmentController

Все страницы находятся в папке views/department/

Шаблон layout.departments


### АДМИНИСТРИРОВАНИЕ ГРУПП

Путь | Название | Метод | Описание
-----|----------|-------|---------
admin/groups | groups.index | get | Вывести список групп
admin/groups/create | groups.create | get | Вывод формы новой группы
admin/groups | groups.store | post | Сохранение новой группы
admin/groups/{id} | groups.show | get | Вывод одной группы
admin/groups/{id}/edit | groups.edit | get | Вывод формы редактирования
admin/groups/{id} | groups.update | put | Сохранение изменений
admin/groups/{id} | groups.destroy | delete | Удаление группы

За администрирование групп отвечает GroupController

Все страницы находятся в папке views/group/

Шаблон layout.groups


### АДМИНИСТРИРОВАНИЕ СПЕЦИАЛЬНОСТЕЙ

Путь | Название | Метод | Описание
-----|----------|-------|---------
admin/specialties | specialties.index | get | Вывести список специальностей
admin/specialties/create | specialties.create | get | Вывод формы новой специальности
admin/specialties | specialties.store | post | Сохранение новой специальности
admin/specialties/{id} | specialties.show | get | Вывод одной специальности
admin/specialties/{id}/edit | specialties.edit | get | Вывод формы редактирования
admin/specialties/{id} | specialties.update | put | Сохранение изменений
admin/specialties/{id} | specialties.destroy | delete | Удаление специальности

За администрирование специальностей отвечает SpecialtyController

Все страницы находятся в папке views/specialty/

Шаблон layout.specialties


### АДМИНИСТРИРОВАНИЕ СОТРУДНИКОВ

Путь | Название | Метод | Описание
-----|----------|-------|---------
admin/employees | employees.index | get | Вывести список сотрудников
admin/employees | employees.store | post | Сохранение нового сотрудника
admin/employees/{id} | employees.show | get | Вывод одного сотрудника
admin/employees/{id} | employees.update | put | Сохранение изменений
admin/employees/{id} | employees.destroy | delete | Удаление сотрудника (деактивация)

За администрирование сотрудников отвечает EmployeeController

Не существует страниц и шаблонов для этого контроллера – всё взаимодействие должно осуществляться на уровне AJAX.

 
## API

Следующие AJAX запросы доступны для незарегистрированных пользователей.

В случае успешного запроса возвращается его результат в виде одной или множества сущностей со статусом ответа 200 (OK).

В случае ошибки возвращается массив ‘error’ => ‘описание’ со статусом ответа 400 (Bad request).


### ГРУППЫ

Получение списка всех групп сотрудников

	ajax/groups (ajax.groups.index [get])

Получение группы по её id

	ajax/groups/{id} (ajax.groups.show [get])


### ОТДЕЛЫ

Получение списка всех отделов

	ajax/departments (ajax.departments.index [get])

Получение отдела по его id

	ajax/departments/{id} (ajax.departments.show [get])


### СПЕЦИАЛЬНОСТИ

Получение списка всех специальностей

	ajax/specialties (ajax.specialties.index [get])

Получение специальности по её id

	ajax/specialties/{id} (ajax.specialties.show [get])


### СОТРУДНИКИ

Получение списка всех сотрудников компании

	ajax/employees (ajax.employees.index [get])

Получение информации о сотруднике по его id

	ajax/employees/{id} (ajax.employees.show [get])

Список сотрудников, принадлежащих указанной группе

	ajax/employees/groups/{id} (ajax.employees.groups [get])

Список сотрудников указанного отдела

	ajax/employees/departments/{id} (ajax.employees.departments [get])

Список сотрудников указанной специальности

	ajax/employees/specialties/{id} (ajax.employees.specialties [get])

Поиск сотрудника по имени.

	ajax/employees/search (ajax.employees.search [post])

В этом запросе обязательно нужно передать post параметр search типа строка.

 
## ОПИСАНИЕ СУЩНОСТЕЙ

#### USERS

	id int
	email string(100)
	password string(100)
	name string(60) nullable
	remember_token string(100) nullable
	blocked boolean default false
	created_at timestamp
	updated_at timestamp

#### DEPARTMENT

	id int
	name string(100)
	created_at timestamp
	updated_at timestamp

#### GROUP

	id int
	name string(100)
	created_at timestamp
	updated_at timestamp

#### SPECIALTY

	id int
	name string(100)
	created_at timestamp
	updated_at timestamp

#### EMPLOYEE

	id int
	firstName string(50)
	lastName string(50)
	photo string(100) nullable
	department_id int nullable foreign key department(id)
	group_id int nullable foreign key group(id)
	specialty_id int nullable foreign key specialty(id)
	cx int nullable
	cy int nullable
	cz int nullable
	short text nullable
	info text nullable
	email string(100) nullable
	phone string(32) nullable
	mobile string(32) nullable
	redmine string(100) nullable
	active boolean default true
	created_at timestamp
	updated_at timestamp


