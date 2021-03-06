<!doctype html>
<html>
<head>
    <!-- 
        Exercise 02_06_01
        Author: Eli Boblett
        Date: 10.22.18 
        MessageBoard.php
     -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Board</title>
    <script src="modernizr.custom.65897.js"></script>
</head>
<body>
<h1>Message Board</h1>
    <?php
    if (isset($_GET['action'])) {
        if (file_exists("messages.txt") || filesize("messages.txt") != 0) {
            $messageArray = file("messages.txt");
            switch ($_GET['action']) {
                case 'Delete First':
                    array_shift($messageArray);
                    break;
            }
            if (count($messageArray) > 0) {
                echo "There are remaining messages in the array.<br>";
            }
            else {
                unlink("message.txt");
            }
        } 
    }
        if (!file_exists("messages.txt") || filesize("messages.txt") == 0) {
            echo "<p>There are no messages posted.</p>\n";
        }
        else {
            $messageArray = file("messages.txt");
            echo "<table style=\"background-color: lightgray\" border=\"1\" width=\"100%\">\n";
            $count = count($messageArray);
            for ($i = 0; $i < $count; $i++) {
                $currMsg = explode("~", $messageArray[$i]);
                echo "<tr>\n";
                echo "<td width=\"5%\" style=\"text-align: center; font-weight: bold\">" . ($i + 1) . "</td>\n";
                echo "<td width=\"95%\"<span style=\"font-weight: bold\">Subject: </span>" . htmlentities($currMsg[0]) . "<br>\n";
                echo "<span style=\"font-weight: bold\">Name: </span>" . htmlentities($currMsg[1]) . "<br>\n";
                echo "<span style=\"text-decoration: underline; font-weight: bold\">Message:</span>" . " " . htmlentities($currMsg[2]) . "<td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
        }
    ?>
    <p>
    <a href="PostMessage.php">Post New Message</a><br>
    <a href="MessageBoard.php?action=Delete%20First">Delete First Message</a>
    </p>
</body>
</html>