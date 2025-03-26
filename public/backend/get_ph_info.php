<?php
include "koneksi.php";

if (isset($_GET['ph'])) {
    $ph_value = (float) $_GET['ph'];
    $query = "SELECT * FROM ph WHERE Nilai_ph = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("d", $ph_value);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Data tidak ditemukan"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Parameter pH tidak diberikan"]);
}

$conn->close();
?>
