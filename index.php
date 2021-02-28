<?php
require_once('db/db.php');

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
<form method="POST" action="/">
    <div class="main">
        <header class="card">
            <div class="account">
                <div class="email"><span>parsasi@rocketmail.com</span></div>
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
                    <div class="image">
                        <img
                            src="https://images.unsplash.com/photo-1614443822810-494e4014f6fc?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        />
                        <input type="checkbox" /> <span>Delete</span>
                    </div>
                </div>
                <div class="image-upload">
                    <h3>Add an image</h3>
                    <span>(Only 4 images allowed)</span>
                    <input type="file" name="new-image"  accept="image/png, image/jpeg" />
                </div>
            </div>
            <div class="cards-row">
                <div class="card websites">
                    <h2>Websites</h2>
                    <div class="website-inputs">
                        <input type="text" placeholder="website..." />
                        <input type="text" placeholder="website..." />
                        <input type="text" placeholder="website..." />
                        <input type="text" placeholder="website..." />
                    </div>
                </div>
                <div class="card notes">
                    <h2>Notes</h2>
                    <div class="notes-inputs">
                        <textarea placeholder="Write some notes..."></textarea>
                    </div>
                    <h2>TBD</h2>
                    <div class="notes-inputs">
                        <textarea placeholder="Write some notes..."></textarea>
                    </div>
                </div>
        </main>
    </div>
</form>

</body>
</html>


