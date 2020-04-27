<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="assets/css/profile.css">
    <script type="text/javascript" src="assets/js/profile.js"></script>
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>
    
    <main>
        <div class="profile_container">
            <div class="profile_container__picture_container">
                <img src="<?php echo $_SESSION["profile_photo"] ?>" alt="profile_container__profile_picture" class="profile_container__profile_picture">
                <div class="image_opacer">
                    <a href="/gasm/public/profile/edit_profile.php">Edit profile</a>
                </div>
            </div>

            <ul class="profile_container__menu">
                <li><button class="button" onclick="showReports()" >My reports </button></li>
                <li><button class="button" onclick="showEvents()"> Events </button></li>
            </ul>

            <ul class="profile_container__feed">
                <div  id="profile_container__feed__reports">
                    <?php 
                        echo '<li>';
                            echo "profile_container__feed__reports";
                        echo '</li>';
                        foreach ($data as $activeReport){
                            echo '<li>';
                                echo $activeReport['username'];
                                echo $activeReport['type'];
                            echo '</li>';
                        }
                    ?>
                </div>

                <div  id="profile_container__feed__events">
                    <?php 
                        echo '<li>';
                            echo "profile_container__feed__events";
                        echo '</li>';
                        foreach ($data as $activeReport){
                            echo '<li>';
                                echo $activeReport['username'];
                                echo $activeReport['type'];
                            echo '</li>';
                        }
                    ?>
                </div>
            </ul>
        </div>
        <?php 
        if (isset($_SESSION['debug'])){
            echo $_SESSION['debug'];
            unset($_SESSION['debug']);
        }
        ?>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
    

</body>

</html>