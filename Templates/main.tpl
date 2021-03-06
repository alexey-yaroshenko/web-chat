<!DOCTYPE html>
<html>
    <head>
        <title>WebChat</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Welcome to <i>WebChat</i></h1>
        <div id="messages">
            {messages}
        </div>
        <div id="entry-message">
            <form id="entry-form" action="index.php" method="post">
                <input type="hidden" name="action" value="addMessage">
                <input type="hidden" name="dialogue_id" value="{dialogue_id}">
                <textarea name="message_text"></textarea>
                <br/>
                <input id="send_button" type="button" value="Send">
                <input type="reset" value="Clear">
            </form>
        </div>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        {javascript}
        <script type="text/javascript" src="app.js"></script>
    </body>
</html>
