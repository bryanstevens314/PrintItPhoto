<?php
require('app/dbconfig.php');
require_once("app/session.php");
include_once 'app/class.crud.php';
$crud = new crud();
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
     <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>E - mail ID</th>
     <th>Contact No</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
  $query = "SELECT * FROM students";       
  $records_per_page=3;
  $newquery = $crud->paging($query,$records_per_page);
  $crud->dataview($newquery);
  ?>
    <tr>
        <td colspan="7" align="center">
    <div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
         </div>
        </td>
    </tr>
 
</table>
<a href="json.php">JSON Export</a> 
       
</div>

<?php include_once 'footer.php'; ?>