<?php

require_once "db.php";

function mapToAPI($row) {
    return [
        "id" => (int)$row["id"],
        "campo1" => $row["nombre"],
        "campo2" => $row["equipo"],
        "campo3" => $row["posicion"],
        "campo4" => (int)$row["edad"],
        "campo5" => (float)$row["promedio_goles"],
        "campo6" => (bool)$row["activo"]
    ];
}

function getAll() {
    $db = DB::connect();
    $stmt = $db->query("SELECT * FROM players");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return array_map("mapToAPI", $rows);
}

function getOne($id) {
    $db = DB::connect();
    $stmt = $db->prepare("SELECT * FROM players WHERE id = ?");
    $stmt->execute([$id]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) return null;

    return mapToAPI($row);
}

function create($data) {
    $db = DB::connect();

    $stmt = $db->prepare("
        INSERT INTO players (nombre, equipo, posicion, edad, promedio_goles, activo)
        VALUES (?, ?, ?, ?, ?, ?)
        RETURNING *
    ");

    $stmt->execute([
        $data["campo1"],
        $data["campo2"],
        $data["campo3"],
        $data["campo4"],
        $data["campo5"],
        $data["campo6"]
    ]);

    return mapToAPI($stmt->fetch(PDO::FETCH_ASSOC));
}

function update($id, $data) {
    $db = DB::connect();

    $stmt = $db->prepare("
        UPDATE players
        SET nombre=?, equipo=?, posicion=?, edad=?, promedio_goles=?, activo=?
        WHERE id=?
        RETURNING *
    ");

    $stmt->execute([
        $data["campo1"],
        $data["campo2"],
        $data["campo3"],
        $data["campo4"],
        $data["campo5"],
        $data["campo6"],
        $id
    ]);

    return mapToAPI($stmt->fetch(PDO::FETCH_ASSOC));
}

function remove($id) {
    $db = DB::connect();

    $stmt = $db->prepare("DELETE FROM players WHERE id = ?");
    $stmt->execute([$id]);
}