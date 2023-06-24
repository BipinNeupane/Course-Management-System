<?php 
if(isset($_SESSION['Sloggedin'])&& $_SESSION['Sloggedin']==true){
?>
<div id="sidebar">
        <ul>
           <img class="wuc" src="../students/wuclogo.png" alt="wuc">
           <li>
                    <a href="myStaffPage.php">
                    <i class="fa fa-users"></i>
                    <span>Staff</span>
                </a>
            </li>
            <li>
                <a href="staffCourse.php">
                    <i class="fas fa-book"></i>
                    <span>Course</span>
                </a>
            </li>
            <li>
                <a href="GradeIt.php">
                    <i class="fa fa-star"></i>
                    <span>Grade</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="Graded.php">
                        <li><i class="fa fa-star"></i>Graded</li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="myTimetable.php">
                    <i class="fa fa-clock-o"></i>
                    <span>Timetable</span>
                </a>
            </li>
            <li>
                <a href="class.php">
                    <i class="fas fa-book"></i>
                    <span>class</span>
                </a>
        </li>
        <li>
                <a href="staffDiary.php">
                    <i class="fas fa-book"></i>
                    <span>Diary</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="createStaffDiary.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="logoutStaff.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sign Out</span>
                </a>
        </li>
    </ul>
</div>
<?php
}else{
    require'staffLogin.php';
}
?>