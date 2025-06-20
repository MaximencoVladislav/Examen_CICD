<?php
$mysqli = new mysqli("db", "root", "root", "myapp_base");

if ($mysqli->connect_error) {
    die("Conexiune eșuată: " . $mysqli->connect_error);
}

$mysqli->query("
    CREATE TABLE IF NOT EXISTS produse (
        id INT AUTO_INCREMENT PRIMARY KEY,
        denumire VARCHAR(100),
        pret DECIMAL(10,2)
    );
");

$result = $mysqli->query("SELECT COUNT(*) FROM produse");
$row = $result->fetch_row();
if ($row[0] == 0) {
    $mysqli->query("INSERT INTO produse (denumire, pret) VALUES
        ('Laptop ASUS ROG', 1700),
        ('Desktop Alienware', 2200),
        ('Mini PC Intel NUC', 850),
        ('Laptop HP Pavilion', 999),
        ('PC Gaming Ryzen', 1450)
    ");
}

$result = $mysqli->query("SELECT denumire, pret FROM produse WHERE pret > 1000");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Magazin Tehnică</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Magazin de Tehnică</h1>
    <h2>Calculatoare performante</h2>
    <div class="produse">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="produs">
                <h3><?= htmlspecialchars($row['denumire']) ?></h3>
                <p>Preț: <strong><?= number_format($row['pret'], 2) ?> EUR</strong></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
