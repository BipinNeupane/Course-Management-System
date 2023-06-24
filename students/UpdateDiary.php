<?php
require'../sqlQueries.php';
    $data=array(
      'status'=>'1'
    );
    updateData('diary',$data,'diary_id',$_GET['id']);
  header("Location:diaryPage.php?id=".$_GET['id']);
?>