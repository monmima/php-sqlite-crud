<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP + SQLite</title>
    <style>


        footer {
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        main {
            display: grid;
            grid-template-columns: 1fr 1fr;

            justify-items: center;
        }
    </style>
</head>
<body>
    <h1>Super CRUD PHP + SQLite</h1>

    <main>
        <div>

            <div>
                <a href="/add.php" title="Add record">Add record</a>
            </div>

            <?php
                // define PDO - tell about the database file
                $pdo = new PDO("sqlite:database.db");

                // write SQL
                $statement = $pdo->query("SELECT * FROM students_tb");

                // run the SQL
                $students = $statement->fetchAll(PDO::FETCH_ASSOC);

                echo "<ul>";

                // show it on the screen as HTML
                foreach($students as $row => $student) {
                    echo "<li><a href=\"/view.php?id=" . $student['id']  . "\">" . $student['sname'] . "</a> - <a href='delete.php?id=" . $student['id']  . "'>Erase this record</a></li>";
                }

                echo "</ul>";
            ?>

        </div>

        <aside>
        	Technologies used for this project:

			<ul>
				<li>PHP</li>
				<li>SQLite</li>
				<li>Heroku</li>
			</ul>

			<p><a href="https://github.com/monmima/php-sqlite-crud" title="Source code on Github">Source code available on Github.</a></p>

        </aside>

    </main>
    



    
    
</body>
</html>