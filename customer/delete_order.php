<?php
require('../configs/database.php');

var_dump($_POST);
if (isset($_POST['delete'])) {
    $id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    try {
        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Редирект на главную страницу после удаления
        header("Location: panier.php");
        exit;
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>
