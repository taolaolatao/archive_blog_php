<?php include('header.php'); include('inc/connect.php'); ?>
<?php session_start(); 

	$conn = new Connection();
	$limit = 6;

	if(isset($_GET['page']))
		$page = $_GET['page'];
	else
		$page = 1;
?>

	<div class="container" style="margin-top: 20px; margin-bottom: 100px">
		<div class="row">
			<!-- Content Main -->
			<div class="col-12 col-md-8 col-lg-8">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="#">Home</a></li>
				  <li class="breadcrumb-item"><a href="#">Library</a></li>
				  <li class="breadcrumb-item active"><?php echo 'Hello World' ?></li>
				</ol>
				<a href="list_product.php">
					<img class="img-fruid" style="width: 50px;" src="https://velaspampeana.com/sitio/wp-content/uploads/2014/04/carrito-compras.png" alt="product - image">&nbsp;
					(<?php  
						if(isset($_SESSION['product']))
						{
							$isNull = null;
							foreach ($_SESSION['product'] as $key => $value) {
								if(isset($key))
									$isNull = 1; 
							}
							if($isNull!==null)
								echo count($_SESSION['product']);
							else
								echo '0';
						}
					?>)
				</a>
				<div class="row mt-4 mb-5">
		<?php 
			$data = $conn->getDataLimit('product', $page, $limit);
			foreach ($data as $key => $value) {
		?>
				<div class="col-12 col-sm-6 col-lg-4">
					<div class="card mb-4" style="height: 500px;">
						<img style="width: 100%; height: 200px; object-fit: contain;" class="card-img-top img-fruid img-thumbnail rounded" src="<?= $value->IMAGE ?>" alt="Card image cap">
						<div class="card-body">
							<h4 class="card-title">
								<a href="#" class="name_product name_product_id<?= $value->ID ?>" id="<?= $value->ID ?>"><?= $value->NAME ?></a>
							</h4>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<p class="card-text">
								<?= number_format($value->PRICE, 0, '.', '.') ?>
								<?= $value->UNIT ?>
							</p>
							<a href="#" id="add_product<?= $value->ID ?>" class="btn btn-danger">Add to cart</a>
						</div>
					</div>
				</div>

		<script type="text/javascript">
			$(document).ready(function(){
				'use stricts';
				$('#add_product' + <?= $value->ID ?>).click(function(e){
					e.preventDefault();
					var id = $('.name_product_id'+<?= $value->ID ?>).attr('id');
					$.ajax({
						url: 'add_product.php',
						type: 'POST',
						cache: false,
						data: {id : id},
						success: function(){
							$('.alert_product').addClass('active');
							setTimeout(() => {
								$('.alert_product').removeClass('active');
								window.location.reload();
							}, 2000);
						}
					});
					
				});
			});
		</script>
		<?php
			}
		?>
		<div class="alert alert-dismissible alert-success alert_product">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Done!!</strong> Add successfully <a href="#" class="alert-link">this important alert message</a>.
		</div>
				</div>

	<div>
		<ul class="pagination">
			<li class="page-item disabled">
		      <a class="page-link" href="#">&laquo;</a>
		    </li>
	<?php 
		$count = $conn->CountTotal('product', 'ID');
	    $numpage = ceil($count / $limit);
	    for ($i = 1; $i <= $numpage; $i++) { 
	?>
	    <?php 
	    	if($i == 1){
	   	?>	
				<li class="page-item active">
			      <a class="page-link" href="./"> <?= $i ?> </a>
			    </li>
	   	<?php
	    	}else{
	    ?>
				<li class="page-item">
			      <a class="page-link" href="./?page=<?= $i ?>"> <?= $i ?> </a>
			    </li>
	<?php
			}
	    }
	?> 
			<li class="page-item">
		      <a class="page-link" href="#">&raquo;</a>
		    </li>
	  	</ul>
	  	<script type="text/javascript">
	  		var pagi = document.querySelectorAll('.pagination .page-item');
	  		var len = pagi.length;
	  		for (var i = 0; i < len; i++) {
	  			pagi[i].classList.remove('active');
	  		}
	  		pagi[<?= $page ?>].classList.add('active');
	  	</script>
	</div>
		<a href="./inc/exportExcel.php" class="btn btn-success">Export File Excel</a>
			</div>
			<?php include('left.php'); ?>
		</div>
	</div>
<?php Connection::dis_connect(); ?>
<?php include('footer.php'); ?>