<?php
    session_start();
    require_once('helpers/auth.php');
    //Auth->authenticate will automatically protect the page against non-logged-in users
    $auth = new Auth();
    $currentUser = $auth->authenticate($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Static Template</title>
</head>
<body>
<form method="POST" action="/save.php" enctype="multipart/form-data">
    <div class="main">
        <header class="card">
            <div class="account">
                <div class="email"><span><?php echo htmlspecialchars($currentUser["Email"]) ?></span></div>
                <div class="logout">
                    <a href="/logout.php">Logout</a>
                </div>
            </div>

            <div class="save">
                <input type="submit" name="save" value="Save Now"/>
            </div>
        </header>
        <main>
            <div class="card images">
                <h2>Images</h2>
                <div class="image-list">
                    <?php
                            foreach($currentUser["Images"] as $image){
                    ?>
                        <div class="image">
                            <img src="<?php echo htmlspecialchars($image) ?>"/>
                            <input type="checkbox" name="<?php echo htmlspecialchars($image) ?>"/> <span>Delete</span>
                        </div>

                    <?php } ?>

                </div>
                <div class="image-upload">
                    <h3>Add an image</h3>
                    <span>(Only 4 images allowed)</span>
                    <input type="file" name="image"  accept="image/png, image/jpeg" />
                </div>
            </div>
            <div class="cards-row">
                <div class="card websites">
                    <h2>Websites</h2>
                    <div class="website-inputs">
                        <?php
                            foreach($currentUser["Websites"] as $web){ ?>
                                <a href="<?php echo htmlspecialchars($web) ?>" target="_blank"><input type="text" style="cursor:pointer;" value="<?php echo htmlspecialchars($web) ?>" disabled="disabled"/></a>
                           <?php }
                        ?>
                        <input type="url" name="website[]" placeholder="website..." />
                        <input type="url" name="website[]" placeholder="website..." />
                        <input type="url" name="website[]" placeholder="website..." />
                        <input type="url" name="website[]" placeholder="website..." />
                    </div>
                </div>
                <div class="card notes">
                    <h2>Notes</h2>
                    <div class="notes-inputs">
                        <textarea name="notes" placeholder="Write some notes..."><?php echo htmlspecialchars($currentUser["Notes"]) ?></textarea>
                    </div>
                    <h2>TBD</h2>
                    <div class="notes-inputs">
                        <textarea name="TBD" placeholder="Write some notes..."><?php echo htmlspecialchars_decode($currentUser["TBD"]) ?></textarea>
                    </div>
                </div>
        </main>
    </div>
</form>

</body>
</html>


