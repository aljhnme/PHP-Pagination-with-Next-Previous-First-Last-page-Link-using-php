<!DOCTYPE html>
<html>
<?php 
  include 'mysqli.php';
?>
 <head>
  <title>PHP Pagination with Next Previous First Last page Link</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <style>
  a {
   padding:8px 16px;
   border:1px solid #ccc;
   color:black;
   font-weight:bold;
  }
  </style>
 </head>
 <body>
  <div class="container">
   <h3 align="center"><title>PHP Pagination with Next Previous First Last page Link</title>
  </h3><br />
   <div class="table-responsive">
    <table class="table table-bordered">
     <tr>
      <td>Name</td>
      <td>Phone</td>
     </tr>
     <?php
     $r_p_page=5;

     if (isset($_GET['values'])) 
     {
        $st_page=$_GET['values'];

     }else{
        $st_page=5;
     }
      $sql="SELECT * FROM `tbl_student` 
            limit $st_page,$r_p_page";

     $result=$connect->query($sql);
   
     while ($row = $result->fetch_assoc()) 
     {
     ?>
     <tr>
      <td><?php echo $row['student_name'];?></td>
      <td><?php echo $row['student_phone'];?></td>
     </tr>
     <?php
      }
     ?>
    </table>
    <div align="center">
    <br />
    <?php
     $sql="SELECT * FROM `tbl_student`";
     $countall=$connect->query($sql);
     $rowcount=mysqli_num_rows($countall);
     
     $__page=ceil($rowcount/5);

     $start_loop=$st_page/5;

     $last_val=($__page-1) * 5;
     
     $start_SH=$start_loop + 4;

     if ($__page-1 <= $start_SH) 
      {
         $end_loop = $__page;
      }else{
         $end_loop = $start_SH;
      }

     if ($st_page > 5) 
     {
        echo "<a href='p.php?values=5'>First</a>";
        echo "<a href='p.php?values=".($st_page-5)."'><<</a>"; 
     }

    for ($i=$start_loop;$i < $end_loop; $i++) 
     { 
        $hide_values=$i*5;
        echo "<a href='p.php?values=".$hide_values."'>".ceil($i)."</a>";
     }

   if ($__page-1 != $start_loop) 
      {
        echo "<a href='p.php?values=".($st_page+5)."'>>></a>";
        echo "<a href='p.php?values=".$last_val."'>Last</a>";
      }
    ?>
    </div>
    <br /><br/>
   </div>
  </div>
 </body>
</html>