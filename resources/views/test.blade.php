<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<form method="POST" action="/store-message">
    @csrf
    <label for="sender_id">Sender ID:</label>
    <input type="text" id="" name="user_id" value="3" required><br><br>

    <label for="content">Message Content:</label>
    <input type="text" name="message" value="dday laf tin nhan">

    <label for="channel_name">Channel id:</label>
    <input type="text" id="channel_name" name="channel_id" value="1" required><br><br>

    <button type="submit">Send Message</button>
</form>

</body>
</html>
