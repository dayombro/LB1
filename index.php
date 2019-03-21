<!DOCTYPE html>
<html>
<head>
<title>Feedback</title>
</head>
<body>

<h1>Feedback</h1>
<h3>Please do not hesitate to contact us</h3>

<form action="/sendmail.php" method="get">
        <label for="emailaddress">E-Mail:<br>
                <input type="text" name="emailname" placeholder="Enter your e-mail address" required><br>
        </label>
        Subject:<br>
        <input type="text" name="betreff" placeholder="Enter the subject" required><br>
        <label for="Nachricht">Message</label><br>
        <textarea id="text" name="text" cols="50" rows="5" placeholder="Enter your message"></textarea><br>
        <br><input type="submit" value="Submit" />
</form>
</body>
</html>







