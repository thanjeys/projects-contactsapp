<?php

/**
 * Edit Contacts.  
 */

$db_conn = mysqli_connect("localhost", 'root', '', 'phplearning_contactapp');
if(!$db_conn) { 
    die("DB Connection Failed.". mysqli_connect_error());
}


 if($_POST) { 
    
    // Remove spaces and Convert special Characters Quotes, Tags to HTML Entity for Security. 
    $name = trim($_POST['name']);
    $contact_no = trim($_POST['contact_no']);
    $email = trim($_POST['email']);

    // Validate Data like empty, right number, right email address.
    $errors = array();
    if(empty($name))
        $errors[] = 'Please enter valid name'; 

    if(empty($contact_no))
        $errors[] = 'Please enter valid contact'; 
    else if(!is_numeric($contact_no))
        $errors[] = 'Please enter only digits'; 

    if(!empty($email))
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            $errors[] = 'Please enter valid email'; 
    
    // Proceed if Error is not found
    if(empty($errors)) {
     
        $id = $_POST['id'];
        // Is Verify contact number  already exists
        $sql = "SELECT COUNT(*) FROM contacts WHERE contact_no=$contact_no AND id != $id";
        if(!($exe_sql = mysqli_query($db_conn, $sql))) { 
            $errors[] = 'Fetching contacts failed'. mysqli_error($db_conn); 
        }
        $row = mysqli_fetch_array($exe_sql);
        $count = $row['COUNT(*)']; 

        if($count > 0) 
            $errors[] = 'Sorry, contact number already exists'; 
        else {
            // Sql for Saving data
            $sql = "UPDATE contacts SET name='$name',contact_no='$contact_no', email='$email' WHERE id=$id ";
            if (mysqli_query($db_conn, $sql) === true) {
                $result =  "Contact has been updated successfully ";
                $name = $contact_no = $email = '';
            } else {
                $errors[] = "Failed to add contact ". mysqli_error($db_conn);
            }
        }
    }
 }



$id = $_GET['id'];
$sql = "SELECT * FROM contacts WHERE id=$id LIMIT 1";  
$dbresult = mysqli_query($db_conn, $sql);
$rowCount = mysqli_num_rows($dbresult); 
$row = mysqli_fetch_array($dbresult); 

if($rowCount < 1) { 
    die("No contacts found.". mysqli_connect_error());
}

$name = trim($row['name']);
$contact_no = trim($row['contact_no']);
$email = trim($row['email']);


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Edit Contact</title>
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
                <h3>New Contact</h3>           
                <?php 
                    if(isset($result)) { ?>
                        <div class="alert alert-success" role="alert">
                        <?php echo $result; ?> 
                        </div>
                <?php } ?>
            
                <?php 
                    if(!empty($errors)) { 
                ?>
                    <div class="alert alert-danger" role="alert">
                    <?php 
                        foreach($errors as $error)
                            echo $error."<br />";
                    ?> 
                    </div>
                <?php } ?>
                
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $id;?>" >
                    <div class="form-group">
                        <label for="name">Name <sup>*</sup></label>
                        <input type="text" class="form-control" name="name" value="<?php echo isset($name)? $name: ''?>" id="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Contact Number <sup>*</sup></label>
                        <input type="number" class="form-control" id="contact_no"  name="contact_no" value="<?php echo isset($contact_no)? $contact_no: ''?>" aria-describedby="contactHelp" placeholder="Enter Contact Number">
                        <small id="contactHelp" class="form-text text-muted">We'll never share your contact number with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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