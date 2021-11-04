<?php
    // define PDO - tell about the database file
    $db = new PDO("sqlite:database.db");

    try {
        $sql = "SELECT * FROM students_tb WHERE id=:myId";

        // prepare statement
        $statement = $db->prepare($sql);

        // get value from querystring and bind
        $id = filter_input(INPUT_GET, "id");
        $statement->bindValue(":myId", $id, PDO::PARAM_INT);

        // execute the query
        $statement->execute();

        // create array of records
        $r = $statement->fetch();
        $db = null;

        // check contents of array
        if (!$r) {
            echo "No record found";
        } else {
            echo "record found";
        }
    }

    catch (PDOException $e) {
        print "We had an error: " . $e->getMessage() . "<br>";
        die();
    }
?>

<h1><?php echo htmlspecialchars($r['id']); ?></h1>
<p>Description: <?php echo htmlspecialchars($r['sname']); ?></p>
<p>Score: <?php echo htmlspecialchars($r['score']); ?></p>