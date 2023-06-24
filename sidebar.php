<?php
if(isset($_SESSION['Aloggedin']) && $_SESSION['Aloggedin']==true){
?>
<div id="sidebar">
        <ul>
           <img class="wuc" src="wuclogo.png" alt="wuc">
            <li>
                <a href="Student.php">
                    <i class="fa fa-users"></i>
                    <span>Students</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addStudent.php">
                    <li ><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                        <a href="archiveStudent.php">
                        <li>
                        <i class="fa fa-archive"></i>    
                        Archive
                    </li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="staff.php">
                    <i class="fa fa-users"></i>
                    <span>Staff</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addStaff.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                        <a href="archiveStaff.php">
                        <li>
                        <i class="fa fa-archive"></i>    
                        Archive
                    </li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="course.php">
                    <i class="fa fa-book"></i>
                    <span>Courses</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addCourse.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                        <a href="courseArchive.php">
                        <li>
                        <i class="fa fa-archive"></i>    
                        Archive
                    </li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="module.php">
                    <i class="fa fa-book"></i>
                    <span>Modules</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addModule.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                    </a>
                        <a href="moduleArchive.php">
                        <li>
                        <i class="fa fa-archive"></i>    
                        Archive
                    </li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="assignment.php">
                    <i class="fa fa-tasks"></i>
                    <span>Assignments</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addAssignment.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                        </a>
                        <a href="assignmentArchive.php">
                        <li>
                        <i class="fa fa-archive"></i>    
                        Archive
                    </li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="grade.php">
                    <i class="fa fa-star"></i>
                    <span>Grade</span>
                </a>
            </li>
            <li>
                <a href="attendance.php">
                    <i class="fa fa-calendar"></i>
                    <span>Attendance</span>
                </a>
            </li>
            <li>
                <a href="personalTutor.php">
                    <i class="fa fa-user"></i>
                    <span>Personal Tutor</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addPersonalTutor.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="timetable.php">
                    <i class="fa fa-clock-o"></i>
                    <span>Time Table</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addTimetable.php">
                        <li><i class="fa-solid fa-plus"></i>Create</li>
                        </a>
                        <a href="timetableArchive.php">
                        <li>
                        <i class="fa fa-archive"></i>    
                        Archive
                    </li>
                        </a>
                    </ul>
                </div>
            </li>
            <li>
                <a href="diary.php">
                    <i class="fa fa-calendar-o"></i>
                    <span>Diary</span>
                </a>
                <div class="expand">
                    <ul>
                    <a href="addDiary.php">
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
              
    </ul>
</div>
<?php
}else{
    require'loginPage.php';
}
?>