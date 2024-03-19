<?php

require 'connect.php';

class QuestController {
    public function createQuest($name, $body, $cost) {
        global $connect;
        if(mysqli_query($connect, "INSERT INTO `Quests` (`id`, `name`, `cost`, `quest`) VALUES (NULL, '$name', '$cost', '$body')")) {
            
            http_response_code(201);
            $res = [
                "status" => true,
                "quest_id" => mysqli_insert_id($connect)
            ];
            return $res;

        } else {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => "Failed to add a new quest. Проверьте передаваемые параметры"
            ];
            return $res;
        }
    }
    
    public function completeQuest($userID, $questID) {
        global $connect;
        if($userID == null){
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => "Failed to add a new quest. Received user_id = null"
            ];
            return $res;
        }
        if(mysqli_query($connect, "INSERT INTO `Exam` (`id`, `user_id`, `ques_id`, `passed`) VALUES (NULL, '$userID', '$questID', 't');")) {
            
            http_response_code(201);
            $res = [
                "status" => true,
                "exam_id" => mysqli_insert_id($connect)
            ];
            return $res;

        } else {
            http_response_code(400);
            $res = [
                "status" => false,
                "message" => "Failed to add a new quest. Проверьте передаваемые параметры"
            ];
            return $res;
        }
    }


}
