<?php

$continue = true;

while ($continue) {
    $continue = true;

    echo "Введите 1, чтобы добавить \n";
    echo "Введите 2, чтобы изменить \n";
    echo "Введите 3, чтобы удалить \n";
    echo "Введите 4, чтобы завершить \n";
    $selectedAction = readline();

    if ($selectedAction === "1") {
        addUser();
    } elseif ($selectedAction === "2") {
        editUser();
    } elseif ($selectedAction === "3") {
        deleteUser();
    } elseif ($selectedAction === "4") {
        $continue = false;
    } else {
        echo "Такого действия нет, повторите выбор! \n";
    }
}

function addUser(): void
{
    $json = file_get_contents("Users.json");
    $data = json_decode($json, true);

    if (count($data["users"]) === 0) {
        $id = 1;
    } else {
        $id = $data["users"][count($data["users"]) - 1]["id"] + 1;
    }

    $data["users"][] = newUser($id);
    insertUserMySql(newUser($id));

    file_put_contents("Users.json", json_encode($data));
}

function editUser(): void
{
    $json = file_get_contents("Users.json");
    $data = json_decode($json, true);

    $userId = readline("Введите id пользователя: ");

    for ($i = 1; $i < count($data["users"]); $i++) {

        $keyOfUser = array_search((int)$userId, $data["users"][$i]);
        if ($keyOfUser !== false) {
            $userKey = $i;
        }
    }
    if ($userKey === null) {
        echo ("Такого пользователя нет! \n");
    } else {
        $data["users"][$userKey] = newUser((int)$userId);
        updateUserMySql(newUser((int)$userId));
        file_put_contents("Users.json", json_encode($data));
    }
}

function deleteUser(): void
{
    $json = file_get_contents("Users.json");
    $data = json_decode($json, true);

    $userId = readline("Введите id пользователя: ");

    for ($i = 1; $i < count($data["users"]); $i++) {

        $keyOfUser = array_search((int)$userId, $data["users"][$i]);
        if ($keyOfUser !== false) {
            $userKey = $i;
        }
    }
    if ($userKey === null) {
        echo ("Такого пользователя нет! \n");
    } else {
        deleteUserMySql($userKey);
        array_splice($data["users"], $userKey, 1);
        file_put_contents("Users.json", json_encode($data));
    }
}

function newUser(int $id): array
{
    $newUser = array(
        "id" => $id,
        "login" => readline('Введите login: '),
        "password" => readline('Введите password: '),
        "name" => readline('Введите name: ')
    );
    return $newUser;
}

function executeQuery(string $query): void
{

    try {
        $dataBase = mysqli_connect("localhost", "root", "3306", "usersdb");
    } catch (Exception $e) {
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }

    try {
        $result = mysqli_query($dataBase, $query);
    } catch (Exception $e) {
        print("Ошибка: Невозможно выполнить запрос");
    }
}

function insertUserMySql($newUser): void
{
    $sqlQuery = "INSERT INTO users SET 
        idUsers = {$newUser["id"]}, 
        login = '{$newUser["login"]}',
        password = '{$newUser["password"]}', 
        name = '{$newUser["name"]}'";
    executeQuery($sqlQuery);
}

function updateUserMySql($newUser): void
{
    $sqlQuery = "UPDATE users SET 
        login = '{$newUser["login"]}',
        password = '{$newUser["password"]}', 
        name = '{$newUser["name"]}'
        WHERE idUsers = {$newUser["id"]}";
    executeQuery($sqlQuery);
}

function deleteUserMySql($userId): void
{
    $sqlQuery = "DELETE FROM users
    WHERE idUsers = {$userId}";
    executeQuery($sqlQuery);
}
