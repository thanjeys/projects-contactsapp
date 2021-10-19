<?php

/**
 * Contacts List.
 */

$db_con = new mysqli('localhost', 'root', '', 'phplearning_contactapp');
if ($db_con->connect_errno) {
    die('DB Connection Error: ' . $db_con->connect_error);
}


$perpage = 5;

if (isset($_GET['pg']) && is_numeric($_GET['pg'])) {
    $pg = $_GET['pg'];
    $limit = ($pg - 1) * $perpage;
} else {
    $pg = 1;
    $limit = 0;
}

$sql = "SELECT * FROM contacts ";
if (isset($_GET['s'])) {
    $s = $_GET['s'];
    $sql .= " WHERE name LIKE '%$s%' OR contact_no LIKE '%$s%' OR email LIKE '%$s%'";
}
$sql .= "ORDER BY name";

// Execute query for no of contacts
$cresult = $db_con->query($sql);

$sql .= " LIMIT $limit, $perpage ";


if (!($result = $db_con->query($sql))) {
    echo "Failed to fetch records";
}

//get total contacts 
$totContacts = $cresult->num_rows;
$totpages = ceil($totContacts / $perpage);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Contacts List</title>
</head>

<body>

    <section class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1>Contacts App</h1>
                </div>
                <div class="col-md-8">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="list.php">All Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="new.php">New</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Contacts List</h3>

                <div class="right" style="float:right; margin: 10px 0">
                    <form>
                        <input type="text" name="s" placeholder="Search" id="" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''; ?>">
                    </form>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $i = $pg * 2 - 1;
                            while ($row = $result->fetch_array()) {
                        ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['contact_no'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><a href="edit.php?id=<?php echo $row['id'] ?>">Edit </a> | <a href="del.php?id=<?php echo $row['id'] ?>">Delete</a></td>
                                </tr>
                            <?php $i++;
                            }
                        } else {  ?>
                            <div class="error">
                                Sorry, there are no contacts.
                            </div>
                        <?php } ?>
                    </tbody>
                </table>

                <p>Total Contacts : <?= $cresult->num_rows ?></p>
                <ul class="list-group list-group-horizontal-md" style="display:none">
                    <?php
                    // List of all pages
                    if (isset($s))
                        $url = "list.php?s=$s&";
                    else
                        $url = "list.php?";

                    for ($i = 1; $i <= $totpages; $i++) {
                    ?>
                        <li  class="list-group-item">
                            <a href="<?php echo $url ?>pg=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>

                    <?php
                    }
                    ?>

                </ul>

                <ul class="list-group list-group-horizontal-md">
                
                <?php
                    if ($pg > 1) {
                ?>  
                    <li class="list-group-item"><a href="<?php echo $url ?>pg=1">First</a></li>
                    <li class="list-group-item"><a href="<?php echo $url ?>pg=<?php echo $pg - 1 ?>">Prev</a></li>
                <?php
                    }
                ?>

                <!-- display pagination links --> 
                <?php
                    if($totpages <= 10)
                    { 
                
                        // List of all pages
                        if (isset($s))
                            $url = "list.php?s=$s&";
                        else
                            $url = "list.php?";

                        for ($i = 1; $i <= $totpages; $i++) {
                        ?>
                            <li  class="list-group-item <?php echo ($pg==$i) ? 'active': ''?>">
                                <a class="" href="<?php echo $url ?>pg=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>

                        <?php
                        }
                       
                    } 
                    else 
                    {
                        if ($pg <= 4) {
                            for ($counter = 1; $counter < 8; $counter++) {
                                $active = "";
                                if ($counter == $pg) {
                                    $active = "active";
                                } 
                                    echo "<li class='list-group-item $active'><a href='?pg=$counter'>$counter</a></li>";
                                 
                            }
                            $second_last = $totpages-1;
                            echo "<li class='list-group-item'><a>...</a></li>";
                            echo "<li class='list-group-item'><a href='?pg=$second_last'>$second_last</a></li>";
                            echo "<li class='list-group-item'><a href='?pg=$totpages'>$totpages</a></li>";

                       }   
                       else if($pg > 4 && $pg < $totpages-4)
                       { 
                            echo "<li  class='list-group-item'><a href='?pg=1'>1</a></li>";
                            echo "<li  class='list-group-item'><a href='?pg=2'>2</a></li>";
                            echo "<li  class='list-group-item'><a>...</a></li>";

                            for ($counter = $pg - 2;$counter <= $pg + 2;$counter++)
                            {
                                if ($counter == $pg) {
                                echo "<li class='list-group-item active'><a>$counter</a></li>";	
                                }else{
                                    echo "<li  class='list-group-item'><a href='?pg=$counter'>$counter</a></li>";
                                }                   
                            }

                            $second_last = $totpages-1;
                            echo "<li class='list-group-item'><a>...</a></li>";
                            echo "<li class='list-group-item'><a href='?pg=$second_last'>$second_last</a></li>";
                            echo "<li class='list-group-item'><a href='?pg=$totpages'>$totpages</a></li>";

                       }
                       else {
                            echo "<li  class='list-group-item'><a href='?pg=1'>1</a></li>";
                            echo "<li  class='list-group-item'><a href='?pg=2'>2</a></li>";
                            echo "<li  class='list-group-item'><a>...</a></li>";
                            for ($counter = $totpages - 6;$counter <= $totpages;$counter++)
                            {
                                if ($counter == $pg) {
                                echo "<li class='list-group-item active'><a>$counter</a></li>";	
                                }else{
                                    echo "<li  class='list-group-item'><a href='?pg=$counter'>$counter</a></li>";
                                }                   
                            }
                        }
                    }
                ?>

               
                <?php
                    if ($pg != $totpages) {
                ?> 
                    <li class="list-group-item"><a href="<?php echo $url ?>pg=<?php echo $pg + 1 ?>">Next</a></li>
                    <li class="list-group-item"><a href="<?php echo $url ?>pg=<?php echo $totpages ?>">Last</a></li>
                <?php
                    }
                ?>
                </ul>





            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>