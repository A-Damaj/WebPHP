<?php
session_start(); 

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .thumbnail {
            width: 200px;
            height: 200px;
            overflow: hidden;
            position: relative;
        }


        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
        }

        .thumbnail:target .zoomed-image {
            display: block;
        }

        .zoomed-image {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .zoomed-image img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            width: 30px;
            height: 30px;
        }

        .close-button img {
            width: 100%;
            height: 100%;
        }
             .welcome-msg {
            position: static;
            text-align:right;
            top: 10px;
            right: 10px;
            padding : 10px;
        }
    </style>

<link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="welcome-msg">
            Welcome, <?php echo $username; ?>!
            <a href="logout.php">Logout</a>
        </div>
        <nav>
            <div class="menu">
                <!-- Add your navigation links here -->
            </div>
            <div class="menu">
                <li class="dropdown-content">
                    <a href="#menu">Menu</a>
                    <ul class="submenu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="cv.php">CV</a></li>
                        <li><a href="contact.php">Contact Info</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                    </ul>
                </li>
            </div>
        </nav>
    </header>
    <div class="gallery">
        <?php
        $galleryData = json_decode(file_get_contents('gallery.json'), true);
        foreach ($galleryData as $image) {
            echo '<div class="thumbnail">';
            echo '<a href="#' . $image . '"><img src=image"/' . $image . '" alt="' . $image . '"></a>';
            echo '<div class="zoomed-image">';
            echo '<a href="#close"><div class="image/close-button"><img src="close.jpg" alt="Close"></div></a>';
            echo '<img src="' . $image . '" alt="' . $image . '">';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
