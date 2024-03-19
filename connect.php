<?php

$connect = mysqli_connect('localhost', 'root', 'admin','test_for_vk');
if ($connect->connect_errno) {
   printf("Не удалось подключиться: %s\n", $connect->connect_error);
   exit();
}