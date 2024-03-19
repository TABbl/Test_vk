<?php
require 'QuestController.php';
require 'UserController.php';
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$request = $_GET['q'];

$params = explode('/', $request);
$action = $params[0];
$id = isset($params[1]) ? $params[1] : null;

switch ($action) {
    case 'users':
        if ($method == 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];
            // Пример использования UserController для создания пользователя
            $userController = new UserController();
            $result = $userController->createUser($name, $password);
            echo json_encode($result);
        }
        elseif ($method == 'GET' && $id && $params[2] == 'quests') {
            // Пример использования QuestController для получения истории заданий пользователя
            
            $userController = new UserController();
            $result = $userController->getUserQuestsHistory($id);
            echo json_encode($result);
        }
        else {
            // Обработка некорректных запросов
            echo json_encode(array('error' => 'Invalid request'));
        }
        break;
    case 'quests':
        if ($method == 'POST' && $id && $params[2] == 'complete') {
            $userID = $_POST['user_id'];
            // Пример использования QuestController для завершения задания
            $questController = new QuestController();
            $result = $questController->completeQuest($userID, $id);
            echo json_encode($result);
        }

        elseif ($method == 'POST') {
            $name = $_POST['name'];
            $body = $_POST['body'];
            $cost = $_POST['cost'];
            // Пример использования QuestController для создания задания
            $questController = new QuestController();
            $result = $questController->createQuest($name, $body, $cost);
            echo json_encode($result);
        }

        else {
            // Обработка некорректных запросов
            echo json_encode(array('error' => 'Invalid request'));
        }
        break;
    default:
        // Обработка некорректных запросов
        echo json_encode(array('error' => 'Invalid request'));
        break;
}
