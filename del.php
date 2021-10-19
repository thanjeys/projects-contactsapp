<?php
/**
 * Delete Contact 
 */

$db_con = new mysqli('localhost', 'root', '', 'phplearning_contactapp');
if($db_con->connect_errno) { 
    die('DB Connection Failed '. $db_con->connect_error); 
}

if($_POST) { 

    $id = $_POST['id']; 
    $sql = "DELETE FROM contacts WHERE id=$id LIMIT 1";
    $result = $db_con->query($sql);
    
    if($result) { 
        echo "<a href='list.php'>Back </a>"; 
        die("Contact deleted successfully"); 
    }

}

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) { 
    die('Invalid Contact'); 
 }

 $id = $_GET['id'];

 $sql = "SELECT * FROM contacts WHERE id= $id LIMIT 1"; 
 $result = $db_con->query($sql);
 $row = $result->fetch_object(); 

 if($result->num_rows < 1) {  
    die("Sorry, Invalid Contact"); 
 }


?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Delete Contact</title>
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

<main>
    <div class="container">
        <div class="row">
        <h3>Are you sure to Delete ? </h3>
        </div>

        <div class="row">
            <ul class="list-group">                     
                <li class="list-group-item"><?php echo $row->name ?></li>
                <li class="list-group-item"><?php echo $row->contact_no ?></li>
                <li class="list-group-item"><?php echo $row->email ?></li>
            </ul>
        </div>

        <a href="list.php"><button type="button" class="btn btn-primary">Cancel</button></a> <br>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row->id ?>">
            <button class="btn btn-danger">Yes</button>
        </form>

    </div>
</main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>