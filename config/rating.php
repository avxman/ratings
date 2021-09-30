<?php

return [

    // Вкл./Откл. рейтинг на сайте
    'enabled' => env('RATING_ENABLED', true),

    // Вид рейтинга на сайте по умолчанию
    'type' =>env('RATING_TYPE', 'like'),

    // Шаблоны рейтинга
    'views'=> [
        'list'=>'vendor.rating.items',
        'item'=>'vendor.rating._item'
    ],

    // Модели рейтинга
    'model'=>[
        'rating'=>\Avxman\Rating\Models\RatingModel::class,
        'rating_user'=>\Avxman\Rating\Models\RatingUserModel::class,
    ],

    // Исключаем рейтинг для моделей
    'except_model'=>[
        //\App\Models\User::class
    ],

];
