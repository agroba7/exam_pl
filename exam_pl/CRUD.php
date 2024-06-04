<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <link rel="stylesheet" href="styles/media.css">
	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/crud.css">
    <link rel="stylesheet" href="styles/forma.css">

</head>
<body>

<header class="header_c">
		<div class="container">
			<nav class="navigation_c">
				<div class="logo_c">
					<h1><a href="index.php">TEST</a></h1>
				</div>
				<div class="links_c">
					<ul>
						<li><a href="">About Us</a></li>
						<li><a href="">Contacts</a></li>
						<li><a href="CRUD.php">CRUD</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</header>

<div class="container">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "examen";

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка действий
if(isset($_POST['action'])) {
    $action = $_POST['action'];

    switch($action) {
        case 'add':
            // Обработка добавления элемента
            $name = $_POST['name'];
            $description = $_POST['description'];
            $img_path = '';
            
            // Обработка загруженного изображения
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "img/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $img_path = $target_file;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "Файл успешно загружен.";
                } else {
                    echo "Ошибка при загрузке файла.";
                }
            }

            $sql = "INSERT INTO cards (name, description, img_path) VALUES ('$name', '$description', '$img_path')";
            if ($conn->query($sql) === TRUE) {
                echo "Элемент успешно добавлен";
            } else {
                echo "Ошибка при добавлении элемента: " . $conn->error;
            }
            break;

        case 'edit':
            // Обработка редактирования элемента
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];

            $sql = "UPDATE cards SET name='$name', description='$description' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "Элемент успешно обновлен";
            } else {
                echo "Ошибка при обновлении элемента: " . $conn->error;
            }
            break;

        case 'delete':
            // Обработка удаления элемента
            $id = $_POST['id'];
            $sql = "DELETE FROM cards WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "Элемент успешно удален ";
            } else {
                echo "Ошибка при удалении элемента: " . $conn->error;
            }
            break;
    }
}

// Отображение списка элементов
$sql = "SELECT * FROM cards";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Список элементов</h2>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='item'>";
        echo "<img src='" . $row["img_path"] . "' alt=''>";
        echo "<p><strong>" . $row["name"] . "</strong> - " . $row["description"] . "</p>";
        echo "<form method='post' class = 'formaOne'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<input type='hidden' name='action' value='edit'>";
        echo "<input type='text' name='name' placeholder='Новое название' required>";
        echo "<textarea class ='textareaOne' name='description' placeholder='Новое описание' required></textarea>";
        echo "<input type='submit' value='Редактировать'>";
        echo "</form>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<input type='hidden' name='action' value='delete'>";
        echo "<input type='submit' value='Удалить'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "0 результатов";
}

// Форма добавления элемента
echo "<h2>Добавить карточку</h2>";
echo "<form method='post' enctype='multipart/form-data'>";
echo "<input type='text' name='name' placeholder='Название' required><br>";
echo "<textarea name='description' placeholder='Описание' required></textarea><br>";
echo "<input type='file' name='image' accept='image/*'><br>";
echo "<input type='hidden' name='action' value='add'>";
echo "<input type='submit' value='Добавить'>";
echo "</form>";

$conn->close();
?>
</div>


    <footer class="footer_c">
		<div class="container">
            <div class="footer_content_c">
                <p class="name">Roman</p>
                <p class="surename">Volimbovschi</p>
                <p class="email">mpe3297@gmail.com</p>
            </div>
		</div>
	</footer>

</body>
</html>
