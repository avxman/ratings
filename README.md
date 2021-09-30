# Модуль рейтинга laravel >= 8.0
#### Работа с рейтингом на сайте. Вывод и сохранение рейтинга.

## Установка модуля с помощью composer
```dotenv
composer require avxman/ratings
```

## Настройка модуля
После установки модуля не забываем объязательно запустить команды artisan
`php artisan vendor:publish --tag="avxman-ratings-migrate"` и после `php artisan migrate`.
Это установит таблицу рейтинга для получения и сохранения данных.

### Команды artisan
- Выгружаем все файлы
```dotenv
php artisan vendor:publish --tag="avxman-ratings-all"
```
- Выгружаем миграционные файлы
```dotenv
php artisan vendor:publish --tag="avxman-ratings-migrate"
```
- Выгружаем файлы моделек
```dotenv
php artisan vendor:publish --tag="avxman-ratings-model"
```
- Выгружаем шаблонные файлы
```dotenv
php artisan vendor:publish --tag="avxman-ratings-view"
```
- Выгружаем конфигурационные файлы
```dotenv
php artisan vendor:publish --tag="avxman-ratings-config"
```

## Методы
### Дополнительные (очерёдность вызова метода - первичная)
- **`setEnabled()`** - перезаписываем вкл./откл. рейтинга определённой модели
- **`setIp()`** - перезаписываем Ip адрес пользователя
- **`setUserAgent()`** - перезаписываем User agent пользователя
- **`setType()`** - перезаписываем тип рейтинга
- **`setView()`** - перезаписываем шаблоны рейтинга
- **`setModelName()`** - перезаписываем модель рейтинга
- **`setModelUserName()`** - перезаписываем модель рейтинга пользователя
- **`setExceptModel()`** - перезаписываем исключение моделей, которые не будут участвовать в рейтинге
- **`reset()`** - сбор параметров рейтинга
### Инициализация или сохранение рейтинга (очерёдность вызова метода - второстепенная)
- **`isError()`** - найдена ли ошибка или отключён рейтинг
- **`getOne()`** - получение рейтинга одиночного результата из модели
- **`getMany()`** - получение рейтинга множественного результата из модели
- **`save()`** - сохранение рейтинга определённой модели
### Вывод (очерёдность вызова метода - последняя, при условии одиночной модели)
- **`toCollection()`** - получаем результат в виде коллекции
- **`toArray()`** - получаем результат в виде массива
- **`toJson()`** - получаем результат в виде json
- **`toHtml()`** - получаем результат в виде html

## Использование метода `getMany()`
При использовании данного метода в классе модели которую привязываем к рейтингу нужно добавить трейт `Avxman\Rating\Traits\RatingModelTrait`.
Когда в модели уже ранее Вами был написан метод `rating()`, тогда его нужно переименовать, так как трейт использует данный метод

## Примеры получения результатов
#### Вызов в controllers
```injectablephp
use App\Models\User;
use Avxman\Rating\Facades\RatingFacade;

//Получаем одиночный рейтинг (только из одного пользователя)
$user = User::with('rating')->first();
RatingFacade::setEnabled(false)->getOne($user);
RatingFacade::setIp('111.111.111.111')->getOne($user);
RatingFacade::setUserAgent('a new user agent')->getOne($user);
RatingFacade::setType('ten')->getOne($user);
RatingFacade::setView('vendor.rating.ten.items', 'vendor.rating.ten._item')->getOne($user);
RatingFacade::setModelName(RatingNewModel::class)->getOne($user);
RatingFacade::setModelUserName(RatingUserNewModel::class)->getOne($user);
RatingFacade::setExceptModel([User::class])->getOne($user);
RatingFacade::reset()->getOne($user);
RatingFacade::isError();
RatingFacade::getOne($user)->toCollection();
RatingFacade::getOne($user)->toArray();
RatingFacade::getOne($user)->toJson();
RatingFacade::getOne($user)->toHtml();

//Получение множественного рейтинга (коллекция из нескольких пользователей)
//Для работы с множественным рейтингом нужно подключить трейт к модели для использования связей
$users = User::with('rating')->get();
RatingFacade::setEnabled(false)->getMany($users, 'toHtml');
RatingFacade::setIp('111.111.111.111')->getMany($users, 'toHtml');
RatingFacade::setUserAgent('a new user agent')->getMany($users, 'toHtml');
RatingFacade::setType('ten')->getMany($users, 'toHtml');
RatingFacade::setView('vendor.rating.ten.items', 'vendor.rating.ten._item')->getMany($users, 'toHtml');
RatingFacade::setModelName(RatingNewModel::class)->getMany($users, 'toHtml');
RatingFacade::setModelUserName(RatingUserNewModel::class)->getMany($users, 'toHtml');
RatingFacade::setExceptModel([User::class])->getMany($users, 'toHtml');
RatingFacade::reset()->getMany($users, 'toHtml');
RatingFacade::getMany($users, 'toCollection');
RatingFacade::getMany($users, 'toArray');
RatingFacade::getMany($users, 'toJson');
RatingFacade::getMany($users, 'toHtml');
$this->result['ratings'] = $users->first()->getRating??'';
```
#### Вызов во views
```injectablephp

```
