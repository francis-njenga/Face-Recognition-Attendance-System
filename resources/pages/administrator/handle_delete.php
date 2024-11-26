<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['id'])) {
        $id = $input['id'];
        $name = "tbl" . $input['name'];


        try {
            $stmt = $pdo->prepare("DELETE FROM $name WHERE Id = :id");
            $stmt->execute([':id' => $id]);

            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID not provided.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
