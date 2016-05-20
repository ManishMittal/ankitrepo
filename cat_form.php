<?php
include_once 'dbMySql.php';
$con = new DB_con();
$table = "categories";
$res=$con->select();
$id=$_GET['id'];
if($id!='')
{
$res2=$con->data_fetch($id);
$row2=mysql_fetch_array($res2);
$sid=$row2['parentid'];


$res3=$con->data_sid($sid);
$row3=mysql_fetch_array($res3);
 $row3['name'];
}
// data insert code starts here.
if(isset($_POST['submit']))
{
 $cname = $_POST['name'];
 $pid = $_POST['parentid'];
 $date=date('d-m-Y');
 
 $res=$con->insert($cname,$pid,$date);
 if($res)
 {
	 header('location:index.php?msg=Category Created Successfully!');
  
 }
 else
 {
  
   header('location:cat_form.php?msg=ERROR!');
  
 }
}
// data insert code ends here.
//updation code
if(isset($_POST['update']))
{
 $cname = $_POST['name'];
 $pid = $_POST['parentid'];
 
 $res=$con->update($cname,$pid,$id);
 if($res)
 {
  header('location:index.php?msg=Category updated Successfully!');
 }
 else
 {
  header('location:index.php?msg=Category updation error');
 }
}
//updation code ends here
?>
<?php
function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '') {

  if (!is_array($user_tree_array))
    $user_tree_array = array();

  $sql = "SELECT `id`, `name`, `parentid` FROM `categories` WHERE 1 AND `parentid` = $parent ORDER BY id ASC";
  $query = mysql_query($sql);
  if (mysql_num_rows($query) > 0) {
    while ($row = mysql_fetch_object($query)) {
      $user_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->name);
      $user_tree_array = fetchCategoryTree($row->id, $spacing . '&nbsp;&nbsp;', $user_tree_array);
    }
  }
  return $user_tree_array;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jQuery.Validate/1.6/jQuery.Validate.min.js"></script>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
	<!-- start: Header -->
	<?php include_once('header.php'); ?>
	<!-- start: Header -->

	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
				<?php include_once('sidebar.php'); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Category</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Add Category Elements</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="" method="post" id="formval" onsubmit="return checkInputs()">
						  <fieldset>
							
							
							  
							 <div class="control-group">
								<label class="control-label" for="selectError">Choose category</label>
								
								
								<?php
								if(empty($id))
								{
									$categoryList = fetchCategoryTree();
								?>
									<div class="controls">
									  <select name="parentid" id="parentid" data-rel="chosen">
										<option value='0'>Parent</option>
													<?php foreach($categoryList as $cl) { ?>
														<option value="<?php echo $cl["id"] ?>"><?php echo $cl["name"]; ?></option>
													<?php } ?>
													</select>
									
									</div>
								<?php } ?>
								
								
								
								<?php
								if(!empty($id))
								{
									$categoryList = fetchCategoryTree();
								?>
									<div class="controls">
									  <select  id="parentid" name="parentid" data-rel="chosen">
										<option value='<?php echo $sid; ?>'><?php if($row3['name']=='0'){ echo "main category"; } else { echo $row3['name']; } ?></option>
													<?php foreach($categoryList as $cl) { ?>
														<option value="<?php echo $cl["id"] ?>"><?php echo $cl["name"]; ?></option>
													<?php } ?>
													</select>
									</div>
								<?php } ?>		
							  </div> 

							<div class="control-group">
								<label class="control-label" for="name">Category Name</label>
								<div class="controls">
<input class="input-xlarge focused" value="<?php echo @$row2['name']; ?>" id="name" type="text" name="name" placeholder="Write category name here....">
								</div>
							  </div>
							           
							
							<div class="form-actions">
							<?php
								if(empty($id)){
							?>	
							  <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
							<?php } else { ?>  
								<button type="submit" name="update" class="btn btn-primary">Update changes</button>
							<?php } ?> 
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

			
			
			

			</div><!--/row-->
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<?php include_once('footer.php'); ?>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
		<script>
			function checkInputs() {
			var name = document.getElementById("name").value;
			if (name != "") {
			return true;
			} else {
			alert("Check all field");
			return false;
			}
			}
		</script>
		<script type="text/javascript">
				$(function() {
					$('#name').keyup(function() {
						if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
							this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
						}
					});
				});
			</script>

	
</body>
</html>
