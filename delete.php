<?php
require('app/dbconfig.php');
require_once("app/session.php");
include_once 'app/class.crud.php';
$crud = new crud();
if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$crud->delete($id);
	header("Location: delete.php?deleted");	
}

?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Success!</strong> record was deleted... 
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Sure !</strong> to remove the following record ? 
		</div>
        <?php
	}
	?>	
</div>

<div class="clearfix"></div>

<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
         <th>#</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>E - mail ID</th>
         <th>Gender</th>
         </tr>
         <?php
         $database = new Database();
		 $dbConnection = $database->dbConnection();
         $stmt = $dbConnection->prepare("SELECT * FROM students WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['first_name']); ?></td>
             <td><?php print($row['last_name']); ?></td>
             <td><?php print($row['email_id']); ?></td>
         	 <td><?php print($row['contact_no']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="users.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to users</a>
    <?php
}
?>
</p>
</div>	
<?php include_once 'footer.php'; ?>