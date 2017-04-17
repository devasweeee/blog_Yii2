<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;

    public function rules() // Эти правила будут использоваться при валидации: формы ввода, с помощью вызова метода validate(), при попытки сохранения в таблицу БД
    {
        return [
            ['username', 'trim'], // обрезает пробелы и превращает в null если нечего не остается
            ['username', 'required'], // 'username' обязательно для заполнения
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'], // 'username' в модели \app\models\User(то есть в таблице user(вспоминаем ActivityRecords) должна быть уникальна) 
            ['username', 'string', 'min' => 2, 'max' => 255], // 'username' это string переменная со значение от 2 до 255 символов
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels() // Используется для локализации
    {
        return [
            'username' => 'Логин',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
        ];
    }

    public function signup() // Регистрация
    {
        if (!$this->validate()) { // Если валидация вернула false то возвращаем null
            return null;
        }
        $user = new User(); // Используем AcriveRecord User
        $user->username = $this->username; // Определяем свойства объекта
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = time();
        return $user->save() ? $user : null; // Сохраняем свойства в таблицу(метод ActivityRecord) user если переменная не равна null
    }
}
