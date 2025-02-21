<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'];
$content = $data['content'];
$user_id = 1; // 假设当前用户ID为1，实际应用中应从会话中获取

$stmt = $conn->prepare("INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $title, $content);
$stmt->execute();

echo json_encode(['success' => true]);

$stmt->close();
$conn->close();
?>