<?php
session_start();
if (isset($_SESSION['Sloggedin']) && $_SESSION['Sloggedin'] == true) {
  require'popUp.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/112bf3ca6e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Staff Diary</title>
    <style>
      .filter {
        float: right;
      }
 /* Style for the header */
 .my-courses-header {
        text-align: center;
        background-color: black;
        padding: 20px;
        margin-bottom: 30px;
      }
      .my-courses{
        color: white;
      }
      /* Calendar styles */
.calendar {
  max-width: 1000px;
  max-height:1000px;
  margin: 0 auto;
  border: 1px solid #ccc;
  font-size: 18px;
  font-family: Arial, sans-serif;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f2f2f2;
  padding: 10px;
}

.weekdays {
  display: flex;
  justify-content: space-between;
  background-color: #f2f2f2;
  padding: 10px;
}
.weekdays > div{
  color:green;
}
.days {
  display: flex;
  flex-wrap: wrap;
  padding: 10px;
}

.days > div {
  width: calc(100% / 7);
  height:4rem;
  padding: 10px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  text-align: center;
  cursor: pointer;
}

.prev-month, .next-month {
  background-color: #e6e6e6;
  border: none;
  color: #555;
  font-size: 18px;
  cursor: pointer;
}

.prev-month:hover, .next-month:hover {
  background-color: #ccc;
}

.days > div.prev-month, .days > div.next-month {
  background-color: #f2f2f2;
  cursor: not-allowed;
}

.days > div:hover {
  background-color: #ddd;
}
#month-year{
  color:red;
}
.event{
  color:red;
}

/* Style for the card container */
.card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: left;
        
      }

      /* Style for the course cards */
      .card {
        width: 260px;
        padding: 20px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        margin-left: 5px;
        margin-right: 5px;
        transition: all 0.3s ease;
        background:skyblue;
    }

      .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
      }

      /* Style for the course code and title */
      .course-code {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
      }

      .course-title {
        color: black;
        font-size: 16px;
      }
    </style>
</head>
<body>
<div class="sectionDivision">  
<?php
require 'staffSidebar.php';
?>
<div id="main">
<?php
// require'header.php';

?>
    <header class="my-courses-header">
    <input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" id="hamburger">
  <span></span>
  <span></span>
  <span></span>
</label>
      <h1 class="my-courses">Diary</h1>
      <div class="current-year" class="my-courses">2022/2023</div>
      <form action="staffDiary.php" method="POST">
        <div class="filter">
        <select name="filter" id="filter">
            <option value="Calender" selected>Calender</option>
            <option value="diary" selected>diary</option>
        </select>
        <button type="submit" name="submit" >Search</button>
        </form>
</div>
    </header>
    <?php 
if(isset($_POST['submit']) && $_POST['filter'] == "diary"){
?>
    <div class="card-container">
        <!-- Course card 1 -->
        <?php 
        $diary = selectData('diary', '*', 'staff_id = '.$_SESSION['staff_id']);
        foreach ($diary as $row) {
        ?>
        <a href="diaryPage.php?id=<?php echo $row['diary_id']?>"> 
            <div class="card">
                <div class="course-title"><?php echo $row['title'];?></div>
            </div>
        </a>
        <?php 
        } 
        ?>
    </div>
<?php 
} else{
?>

    <div class="calendar">
  <div class="header">
    <button class="prev" onclick="prevMonth()">&#10094;</button>
    <h2 id="month-year"></h2>
    <button class="next" onclick="nextMonth()">&#10095;</button>
  </div>
  <div class="weekdays">
    <div>Sun</div>
    <div>Mon</div>
    <div>Tue</div>
    <div>Wed</div>
    <div>Thu</div>
    <div>Fri</div>
    <div>Sat</div>
  </div>
  <div class="days">
    <div></div>
</div>
<script>
var currentDate = new Date();

function renderCalendar() {
  var monthDays = document.querySelector(".days");
  var monthYear = document.querySelector("#month-year");
  
  // clear previous month days
  monthDays.innerHTML = "";

  // set month and year
  var month = currentDate.getMonth();
  var year = currentDate.getFullYear();
  monthYear.innerHTML = monthName(month) + " " + year;
  
  // set starting day of month
  var startingDay = new Date(year, month, 1).getDay();

  // set number of days in month
  var daysInMonth = new Date(year, month + 1, 0).getDate();

  // render days of previous month
  for (var i = startingDay - 1; i >= 0; i--) {
    var day = document.createElement("div");
    day.classList.add("prev-month");
    day.innerHTML = daysInMonth - i;
    monthDays.appendChild(day);
  }

  // render days of current month
  for (var i = 1; i <= daysInMonth; i++) {
    var day = document.createElement("div");
    day.classList.add("current-month");
    day.innerHTML = i;
    monthDays.appendChild(day);
  }

  // render days of next month
  var nextMonthDays = monthDays.children.length % 7;
  if (nextMonthDays > 0) {
    for (var i = 1; i <= 7 - nextMonthDays; i++) {
      var day = document.createElement("div");
      day.classList.add("next-month");
      day.innerHTML = i;
      monthDays.appendChild(day);
    }
  }
}

function prevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();

  // fetch diary entries using AJAX
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var entries = JSON.parse(this.responseText);
      // loop through the entries and add them to the calendar
      for (var i = 0; i < entries.length; i++) {
        addEventToCalendar(entries[i].title, entries[i].date);
      }
    }
  };
  xhttp.open("GET", "fetch_diary_entries.php", true);
  xhttp.send();
}

function nextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();

  // fetch diary entries using AJAX
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var entries = JSON.parse(this.responseText);
      // loop through the entries and add them to the calendar
      for (var i = 0; i < entries.length; i++) {
        addEventToCalendar(entries[i].title, entries[i].date);
      }
    }
  };
  xhttp.open("GET", "fetch_diary_entries.php", true);
  xhttp.send();
}

function monthName(month) {
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  return months[month];
}
function addEventToCalendar(title, date) {
  // get all the day elements in the calendar
  var days = document.querySelectorAll(".days > .current-month");
  // loop through each day element
  for (var i = 0; i < days.length; i++) {
    // get the day number from the element
    var dayNumber = days[i].innerHTML;
    // get the month and year from the calendar
    var monthYear = document.querySelector("#month-year").innerText;
    var month = monthYear.split(" ")[0];
    var year = monthYear.split(" ")[1];
    // create a date string in the format "yyyy-mm-dd"
    var dateString = year + "-" + (new Date(Date.parse(month +" "+ dayNumber+ ", " + year))).toISOString().slice(5, 10);
    var adjustedDate = new Date(Date.parse(dateString + "T00:00:00"));
    adjustedDate.setDate(adjustedDate.getDate() +2);
    dateString = adjustedDate.toISOString().slice(0, 10);
    // check if the day matches the event date
    if (dateString == date) {
      // create a new span element for the event title
      var eventTitle = document.createElement("span");
      eventTitle.innerHTML = title;
      eventTitle.classList.add("event");
      // add the event title to the day element
      days[i].appendChild(eventTitle);
    }
  }
}
renderCalendar();
</script>
<?php
$diary = selectData('diary', '*', 'staff_id = '.$_SESSION['staff_id']);
foreach($diary as $row){
  $title=$row['title'];
  $date = $row['date'];
  echo "<script>addEventToCalendar('$title', '$date');</script>";
}
?>
<?php } ?>
</div>
  </body>
</html>
<?php }
else{
  // Redirect the user to the login page if they're not already logged in
  header('Location: staffLogin.php');
  exit;
}
?>
<script>
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');

hamburger.addEventListener('click', () => {
  sidebar.classList.toggle('active');
  hamburger.classList.toggle('active');
});
</script>