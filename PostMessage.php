<!doctype html>
<html>
<head>
    <!-- 
        Exercise 02_06_01
        Author: Eli Boblett
        Date: 10.19.18 
        PostMessage.php
     -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Message</title>
    <script src="modernizr.custom.65897.js"></script>
</head>
<body>
    <?php
    if (isset($_POST['submit'])) {
        $subject = stripslashes($_POST['subject']);
        $name = stripslashes($_POST['name']);
        $message = stripslashes($_POST['message']);

        // replace tildes
        $subject = str_replace("~", "-", $subject);
        $name = str_replace("~", "-", $name);
        $message = str_replace("~", "-", $message);
        $messageRecord = "$subject~$name~$message\n";
        $fileHandle = fopen("message.txt", "ab");
        if (!$fileHandle) {
            echo "There was an error saving your message!\n";
        }
        else {
            fwrite($fileHandle, $messageRecord);
            fclose($fileHandle);
            echo "Your message has been saved\n";
        }
    }
    ?>

    <h1>Post New Message</h1>
    <hr>
    <form action="PostMessage.php" method="POST">
        <span style="font-weight: bold;">Subject: <input type="text" name="subject"></span>
        <span style="font-weight: bold;">Name: <input type="text" name="name"></span><br>
        <textarea name="message" cols="80" rows="6" style="margin: 10px 5px 5px"></textarea><br>
        <input type="reset" name="reset" value="Reset Form">
        <input type="submit" name="submit" value="Post Message">
    </form>
    <hr>
    <p>
        <a href="MessageBoard.php">View Message</a>
    </p>
</body>
</html>