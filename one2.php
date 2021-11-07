<?php 
    // $db->close();
    // echo $_GET['id'];
?> 

<!-- get database content -->
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

<!-- print database content -->
<?php
    // has the form been submitted?
    // if not, show the HTML form
    if (!isset($_POST['submit'])) {
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF'] . "?id=" . $r['id']); ?>" method="post">

    <label for="sname">Student's Name</label>
    <input type="text" name="sname" required value="<?php echo htmlspecialchars($r['sname']); ?>">

    <label for="score">Score</label>
    <input type="number" name="score" required value="<?php echo htmlspecialchars($r['score']); ?>">

    <button type="submit" name="submit">Submit</button>

</form>

<!-- update database content -->
<?php

    } else {


        try {
            $id = $_POST['id'];

            $db = new PDO("sqlite:database.db");
            // print out error messages is something goes wrong
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE students_tb SET sname = :sname, score = :score WHERE id = $id";

            // UPDATE table_name
            // SET column1 = value1, column2 = value2...., columnN = valueN
            // WHERE [condition];

            $stat = $db->prepare($sql);

            // named params

            $sname = filter_input(INPUT_POST, "sname");
            $stat->bindValue(":sname", $sname, PDO::PARAM_STR);

            $score = filter_input(INPUT_POST, "score");
            $stat->bindValue(":score", $score, PDO::PARAM_INT);
            
            $success = $stat->execute();

            // does the value exist?
            if ($success) {
                echo "The student has been updated in the database.";
                echo "<p><a href='/'>Go back to the main page.</a></p>";
            } else {
                echo "The student has NOT been updated in the database.";
                echo "<p><a href='/'>Go back to the main page.</a></p>";
            }

            $db = null;

        } catch (PDOException $e) {
            // for development
            print "We had an error: " . $e->getMessage() . "<br>";
            die();
        }

    }
?>
