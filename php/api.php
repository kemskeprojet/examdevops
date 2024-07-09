
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permettre l'accès depuis n'importe quel domaine
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); // Permettre les méthodes HTTP
header('Access-Control-Allow-Headers: Content-Type'); // Permettre l'en-tête Content-Type

include 'connect.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = json_decode(file_get_contents('php://input'), true);

if ($method == 'GET') {
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($tasks);
} elseif ($method == 'POST') {
    $title = $request['title'];
    $description = $request['description'];
    $status = $request['status'];
    $sql = "INSERT INTO tasks (title, description, status) VALUES ('$title', '$description', '$status')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Task created successfully"]);
    } else {
        echo json_encode(["error" => "Error creating task: " . mysqli_error($conn)]);
    }
} elseif ($method == 'PUT') {
    $id = $request['id'];
    $title = $request['title'];
    $description = $request['description'];
    $status = $request['status'];
    $sql = "UPDATE tasks SET title='$title', description='$description', status='$status' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Task updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating task: " . mysqli_error($conn)]);
    }
} elseif ($method == 'DELETE') {
    $id = $request['id'];
    $sql = "DELETE FROM tasks WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Task deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting task: " . mysqli_error($conn)]);
    }
}

mysqli_close($conn);

header('Content-Type: application/json');
include 'connect.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = json_decode(file_get_contents('php://input'), true);

if ($method == 'GET') {
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($tasks);
} elseif ($method == 'POST') {
    $title = $request['title'];
    $description = $request['description'];
    $status = $request['status'];
    $sql = "INSERT INTO tasks (title, description, status) VALUES ('$title', '$description', '$status')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Task created successfully"]);
    } else {
        echo json_encode(["error" => "Error creating task: " . mysqli_error($conn)]);
    }
} elseif ($method == 'PUT') {
    $id = $request['id'];
    $title = $request['title'];
    $description = $request['description'];
    $status = $request['status'];
    $sql = "UPDATE tasks SET title='$title', description='$description', status='$status' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Task updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating task: " . mysqli_error($conn)]);
    }
} elseif ($method == 'DELETE') {
    $id = $request['id'];
    $sql = "DELETE FROM tasks WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Task deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting task: " . mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>
