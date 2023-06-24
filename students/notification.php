<!-- HTML code for the page -->
<html>
<head>
    <script>
        // Define a function to show the notification
        function showNotification() {
            // Get the messages from the PHP variable
            var messages = <?php echo $js_messages; ?>;

            // Get the last message from the array
            var message = messages[messages.length - 1];

            // Show the message in the custom alert box
            showAlertBox(message);
        }

        // Call the showNotification function when the page loads
        window.onload = showNotification;
    </script>

    <!-- Include the CSS for the custom alert box -->
    <link rel="stylesheet" href="myAlertBox.css">
</head>
<body>
    <!-- Include the HTML for the custom alert box -->
    <?php require('myAlertBox.php'); ?>

    <!-- HTML content for the page -->
</body>
</html>
