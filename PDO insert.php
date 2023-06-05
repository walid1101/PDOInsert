<?php
$servername = "localhost";
$username = "jouw_gebruikersnaam";
$password = "jouw_wachtwoord";
$dbname = "Winkel";

/ Verbinding maken met de database
$conn = new mysqli($servername, $username, $password, $dbname);

/ Controleren op verbindingsfouten
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/ Controleren of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    / Gegevens ophalen uit het formulier
    $product_naam = $_POST["product_naam"];
    $prijs_per_stuk = $_POST["prijs_per_stuk"];
    $omschrijving = $_POST["omschrijving"];

    / SQL-query voor het invoegen van een nieuw product
    $sql = "INSERT INTO Producten (product_naam, prijs_per_stuk, omschrijving)
            VALUES ('$product_naam', '$prijs_per_stuk', '$omschrijving')";

    / Uitvoeren van de query
    if ($conn->query($sql) === TRUE) {
        echo "Product toegevoegd aan de database.";
    } else {
        echo "Fout bij het toevoegen van het product: " . $conn->error;
    }
}

/ Verbinding sluiten
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Toevoegen</title>
</head>
<body>
    <h2>Product Toevoegen</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="product_naam">Product Naam:</label>
        <input type="text" name="product_naam" id="product_naam" required><br><br>

        <label for="prijs_per_stuk">Prijs per Stuk:</label>
        <input type="number" step="0.01" name="prijs_per_stuk" id="prijs_per_stuk" required><br><br>

        <label for="omschrijving">Omschrijving:</label>
        <textarea name="omschrijving" id="omschrijving" required></textarea><br><br>

        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>
