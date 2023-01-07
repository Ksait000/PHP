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
