<?php
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']){
?>
<div id="sidebar">
        <ul>
           <img class="wuc" src="wuclogo.png" alt="wuc">
           <li>
                    <a href="myStudentPage.php">
                    <i class="fa fa-users"></i>
                    <span>Student</span>
                </a>
            </li>
            <li>
                <a href="myCourse.php">
                    <i class="fa fa-users"></i>
                    <span>Course</span>
                </a>
            </li>
            <li>
                <a href="myGrade.php">
                    <i class="fa fa-users"></i>
                    <span>Grade</span>
                </a>
            </li>
            <li>
                <a href="myClass.php">
                    <i class="fas fa-book"></i>
                    <span>Class</span>
                </a>
            </li>
            <li>
                <a href="myTimetable.php">
                    <i class="fa fa-clock-o"></i>
                    <span>Timetable</span>
                </a>
            </li>
            <li>
                <a href="StudentDiary.php">
                    <i class="fas fa-book"></i>
                    <span>Diary</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="createStudentDiary.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                    </ul>
                </div>
            </li>
          
            <li>
                <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sign Out</span>
                </a>
        </li>
    </ul>
</div>
<?php }else{
	require'loginPage.php';
}