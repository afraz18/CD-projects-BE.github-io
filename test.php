<?php
// Minimal test blog-details.php - paste this to debug quickly
// EDIT DB CREDENTIALS BELOW before running. Save as UTF-8 WITHOUT BOM.

// show all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ---- DB config: edit these values to match your local DB ----
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';      // default XAMPP root has no password
$db_name = 'myproject'; // change if your DB name differs
// ------------------------------------------------------------

$conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    echo "<h2>DB Connection failed</h2>";
    echo "host: " . htmlentities($db_host) . "<br>";
    echo "user: " . htmlentities($db_user) . "<br>";
    echo "error: " . htmlentities(mysqli_connect_error());
    exit;
}

// ensure id param
$post_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$post_id) {
    echo "<p>No id provided. Try ?id=1</p>";
    exit;
}

// prepare statement to fetch a post
$sql = "SELECT id, tittle, title, description, image, author, created_at, comment FROM blogs WHERE id = ? LIMIT 1";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res && $row = mysqli_fetch_assoc($res)) {
        echo "<h1>Post found (id={$post_id})</h1>";
        echo "<strong>Title:</strong> " . htmlentities($row['tittle'] ?? $row['title'] ?? '') . "<br>";
        echo "<strong>Author:</strong> " . htmlentities($row['author'] ?? 'Admin') . "<br>";
        echo "<strong>Created:</strong> " . htmlentities($row['created_at'] ?? '') . "<br>";
        echo "<strong>Comments:</strong> " . (int)$row['comment'] . "<br>";
        echo "<hr>";
        echo "<div><strong>Description (raw):</strong><br><pre>" . htmlentities($row['description'] ?? '') . "</pre></div>";
        echo "<hr>";
        echo "<div><strong>Image source resolved:</strong><br>";
        $img = $row['image'] ?? '';
        if (!$img) $imgsrc = 'images/resource/blg-details.jpg';
        elseif (filter_var($img, FILTER_VALIDATE_URL)) $imgsrc = $img;
        else $imgsrc = 'uploads/' . basename($img);
        echo htmlentities($imgsrc) . "<br>";
        echo "<img src=\"" . htmlentities($imgsrc) . "\" alt=\"img\" style=\"max-width:300px;margin-top:10px;\">";
        echo "</div>";
    } else {
        echo "<h2>No post found with id={$post_id}</h2>";
        // show a small sample of table structure (if privileges allow)
        $r = mysqli_query($conn, "SHOW COLUMNS FROM blogs");
        if ($r) {
            echo "<h3>blogs table columns:</h3><ul>";
            while ($c = mysqli_fetch_assoc($r)) {
                echo "<li>" . htmlentities($c['Field']) . " (" . htmlentities($c['Type']) . ")</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Unable to show table columns (check privileges or table existence).</p>";
        }
    }
    mysqli_stmt_close($stmt);
} else {
    echo "<h2>SQL prepare failed</h2>";
    echo htmlentities(mysqli_error($conn));
}
mysqli_close($conn);
?>
