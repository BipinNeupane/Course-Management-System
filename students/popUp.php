<?php

require'../sqlQueries.php';
$currentDate = date('Y-m-d');
$diary = selectData('diary', '*', "student_id='".$_SESSION['student_id']."' AND status = 0 AND date='$currentDate'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Diary</title>
    <style>
        /* Style for the pop-up message */
        #popup {
            position: fixed;
            top: 15%;
            left: 80%;
            transform: translate(-50%, -50%);
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }

        /* Style for the overlay */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }
        #myButton {
            background-color: blue;
            color: black;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 50px;
          }
    </style>
</head>
<body>
    <?php if(!empty($diary)){?>
    <!-- Pop-up message -->
    <?php foreach($diary as $row){?>
    <div id="popup">
        <h2>Diary Content</h2>
        <p><?php echo $row['title'];?></p>
        <button id="myButton"><a href="UpdateDiary.php?id=<?php echo $row['diary_id']?>" style="color:white">Go to page</a></button>
    </div>
    <?php }?>
    <!-- Overlay to dim the background -->
    <div id="overlay"></div>

    <!-- JavaScript to show/hide the pop-up message -->
    <script>
        var popup = document.getElementById("popup");
        var overlay = document.getElementById("overlay");
        var button = document.getElementById("myButton");

        function showPopup() {
            popup.style.display = "block";
            overlay.style.display = "block";
        }

        function hidePopup() {
            popup.style.display = "none";
            overlay.style.display = "none";
        }

        // Call the showPopup() function to display the pop-up message
        showPopup();

        // Add an event listener to the button that calls the hidePopup() function
        button.addEventListener("click", hidePopup);
    </script>
    <?php }?>
</body>
</html>


