<?php
require 'connect.php';

class UserController {
    public function createUser($name, $password) {
        global $connect;
        if(mysqli_query($connect, "INSERT INTO `Users` (`id`, `name`, `password`, `balance`) VALUES (NULL, '$name', '$password', 0)")) {
            
            http_response_code(201);
            $res = [
                "status" => true,
                "user_id" => mysqli_insert_id($connect)
            ];
            return $res;

        } else {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => "Failed to add a new user. Проверьте передаваемые параметры"
            ];
            return $res;
        }
    }

    public function getUserQuestsHistory($userID) {
        global $connect;
        $quests = mysqli_query($connect, "SELECT `name` FROM Quests Q join Exam E on Q.id = E.ques_id WHERE E.user_id=$userID and passed = 't'");
        if(mysqli_num_rows($quests) === 0){
            http_response_code(404);
            $res = [
                "status" => false,
                "message" => "Not found user_id in Exam"
            ];
            return $res;
        } else{
            $questsList = [];
            while($quest = mysqli_fetch_assoc($quests)){
                $questsList[] = $quest;
            }
            return $questsList;
        }
    }
}
