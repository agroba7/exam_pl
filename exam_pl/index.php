<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="styles/media.css">
	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/reset.css">
	<link rel="stylesheet" href="styles/contacts.css">
	<link rel="stylesheet" href ="styles/forma.css">
	<title>Project</title>
</head>
<body>
	
	<header class="header">
		<div class="container">
			<nav class="navigation">
				<div class="logo">
					<h1>TEST</h1>
				</div>
				<div class="links">
					<ul>
						<li><a href="">About Us</a></li>
						<li><a href="">Contacts</a></li>
						<li><a href="CRUD.php">CRUD</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</header>

	<div class="aboutUs">
		<div class="container">
			<div class="content_aboutUs">
				<div class="text">
					<h2>About Us</h2>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis maxime rerum nobis, in laboriosam, nam fuga 
						assumenda maiores reiciendis eos consectetur distinctio incidunt quisquam ratione pariatur ipsum eius magni 
						blanditiis?Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis maxime rerum nobis, in laboriosam, nam fuga 
						assumenda maiores reiciendis eos consectetur distinctio incidunt quisquam ratione pariatur ipsum eius magni 
						blanditiis?
					</p>
				</div>
				<div class="image">
					<img src="https://via.placeholder.com/300x400"/>
				</div>
			</div>
		</div>
	</div>


	<div class="database_Data">
		<div class="container">
		<div class="cards">
		<?php
		// Подключение к базе данных
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "examen";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Выборка данных из таблицы cards
		$sql = "SELECT * FROM cards";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Вывод данных в виде карточек
			while($row = $result->fetch_assoc()) {
				echo "<div class='card'>";
				echo "<img src='" . $row["img_path"] . "' alt='Card Image' width='300px' height='300px'>";
				echo "<div class='card-info'>";
				echo "<h3>" . $row["name"] . "</h3>";
				echo "<p>" . $row["description"] . "</p>";
				echo "</div>";
				echo "</div>";
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
		</div>

		</div>
	</div>


	<div class="contacts">
		<div class="container">
		

		<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "examen";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение данных из формы
    $name = $_POST['user_name'];
    $phone = $_POST['phone'];

    // SQL запрос для вставки данных в таблицу user
    $sql = "INSERT INTO user (user_name, phone) VALUES ('$name', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Ошибка при регистрации: " . $conn->error;
    }

    // Закрытие подключения к базе данных
    $conn->close();
}
?>

<h2>Оставить контакты</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="user_name">Имя:</label><br>
    <input type="text" id="user_name" name="user_name" required><br><br>
    <label for="phone">Номер телефона:</label><br>
    <input type="text" id="phone" name="phone" required><br><br>
    <input type="submit" value="Зарегистрироваться">
</form>

		</div>
	</div>


	<footer class="footer">
		<div class="container">
		<div class="footer_content">
		<p class="name">Roman</p>
		<p class="surename">Volimbovschi</p>
		<p class="email">mpe3297@gmail.com</p>
		</div>
		</div>
	</footer>

	<script src="scripts/index.js"></script>
</body>
</html>