<?php include('header.php'); include('inc/connect.php'); ?>
<?php session_start() ?>

<?php 
	if(isset($_POST['sm_update']))
	{
		foreach ($_POST['amount'] as $key => $value) {
			if(($value==0) AND (is_numeric($value)))
			{
				unset($_SESSION['product'][$key]);
			}
			if(($value>0) AND (is_numeric($value)))
			{
				$_SESSION['product'][$key] = $value;
			}
		}
		header('location: list_product.php');
	}
?>
	<div class="container" style="margin-top: 20px; margin-bottom: 100px">
		<div class="row">
			<!-- Content Main -->
			<div class="col-12 col-md-12 col-lg-8">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="#">Home</a></li>
				  <li class="breadcrumb-item"><a href="#">Library</a></li>
				  <li class="breadcrumb-item active">Data</li>
				</ol>
				<a href="#">
					<img class="img-fruid" style="width: 50px" src="https://velaspampeana.com/sitio/wp-content/uploads/2014/04/carrito-compras.png" alt="product - image">&nbsp;
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
					?>) &nbsp;&nbsp;&nbsp;
					<a href="del_product.php?id=0">Clear All </a>
				</a>
		<div class="row mt-4 mb-5">
		<?php 
			if(isset($isNull) AND $isNull!==null)
			{
		?>
			<div class="col-12 col-sm-12 col-lg-12">
				<form method="POST" action="">
					<table class="table table-hover table-dark table-striped">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">NAME</th>
					      <th scope="col">IMAGE</th>
					      <th scope="col" class="text-center">PRICE</th>
					      <th scope="col" class="text-center">TOTAL MONEY</th>
					      <th scope="col" class="text-right">AMOUNT</th>
					      <th scope="col">DELETE</th>
					    </tr>
					  </thead>
					  <tbody>
					<?php 
					    foreach ($_SESSION['product'] as $key => $value) {
					    	$items[] = $key;
					    }
					    $total_id = implode(',', $items);
					    $total_money = 0;
					    $total_product = 0;
					    $conn = new Connection();
					    $data = $conn->getDataById('product', $total_id);
					    foreach ($data as $key => $value) {
					?>
						<tr class="table-secondary text-dark">
					      	<th scope="row"><?= $value->ID ?></th>
					      	<td><?= $value->NAME ?></td>
					      	<td>
					      		<img style="width: 60px" src="<?= $value->IMAGE ?>" alt="Image - Cart">
					      	</td>
					      	<td class="text-center"><?= number_format($value->PRICE, 0, ',',',') ?><?= ' '.$value->UNIT ?></td>
					      	<td class="text-center">
					      		<?= number_format($_SESSION['product'][$value->ID] * $value->PRICE,0,',',',').' '.$value->UNIT ?>
					      	</td>
					      	<td class="text-right">
								<span class="amount_canedit">
									<?= $_SESSION['product'][$value->ID]  ?>
								</span>
								<input type="number" style="width: 100px" class="form-control amount hidden" id="amount" name="amount[<?=$value->ID?>]" value="<?=$_SESSION['product'][$value->ID]?>">
					      	</td>
					      	<td class="text-dark text-center">
					      		<a href="del_product.php?id=<?= $value->ID ?>"><i class="fa fa-trash-o"></i></a>
					      	</td>
					    </tr>
					<?php
						$total_product += $_SESSION['product'][$value->ID];
						$total_money += $_SESSION['product'][$value->ID] * $value->PRICE;
					    }
					?>
					<tr>
						<th class="text-right" scope="row" colspan="5" align="right">
							<?php 
								if(isset($total_money))
									echo '<span style="font-weight: bold">Tổng tiền:</span> &nbsp;' . number_format($total_money,0,',',',') . ' đ';
							?>
						</th>
						<td class="text-right">
							<?php 
								if(isset($total_product))
									echo '<span style="font-weight: bold">Số lượng:</span>&nbsp;' . $total_product;
							?>
						</td>
					</tr>
					<tr class="table-light">
						<td colspan="7">
							<button type="submit" name="sm_update" class="btn btn-outline-danger btn-block">Cập nhật giỏ hàng</button>
						</td>
					</tr>
					<tr class="table-light">
						<td colspan="4">
							<button type="button" class="btn btn-outline-danger btn-block">Tiếp tục mua hàng</button>
						</td>
						<td colspan="3">
							<button type="button" class="btn btn-outline-danger btn-block">Thanh toán</button>
						</td>
					</tr>
				</tbody>
			</table> 
			<script type="text/javascript">
				document.addEventListener('DOMContentLoaded', function(){
					var amount_label = document.getElementsByClassName('amount_canedit');
					var amount_input = document.getElementsByClassName('amount');
					for (var i = 0; i < amount_label.length; i++) {
						amount_label[i].addEventListener('click', function() {
							for (var i = 0; i < amount_label.length; i++) {
								amount_label[i].classList.add('hidden');
								amount_input[i].classList.remove('hidden');
							}
						});
						amount_input[i].addEventListener('blur', function() {
							for (var i = 0; i < amount_label.length; i++) {
								amount_label[i].classList.remove('hidden');
								amount_input[i].classList.add('hidden');
								amount_label[i].innerHTML = amount_input[i].value;
							}
						});
					}

				}, false);
			</script>
				</form>
			<?php 
				}
				else
				{
					echo 'Giỏ hàng của bạn đang trống';
				}
			?>
			</div>
		</div>
		<div class="alert alert-dismissible alert-success alert_product">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong>Done!!</strong> Add successfully <a href="#" class="alert-link">this important alert message</a>.
				</div>
		<?php if(isset($isNull) AND $isNull!==null){ ?>
				<div>
				  <ul class="pagination">
				    <li class="page-item disabled">
				      <a class="page-link" href="#">&laquo;</a>
				    </li>
				    <li class="page-item active">
				      <a class="page-link" href="#">1</a>
				    </li>
				    <li class="page-item">
				      <a class="page-link" href="#">2</a>
				    </li>
				    <li class="page-item">
				      <a class="page-link" href="#">3</a>
				    </li>
				    <li class="page-item">
				      <a class="page-link" href="#">4</a>
				    </li>
				    <li class="page-item">
				      <a class="page-link" href="#">5</a>
				    </li>
				    <li class="page-item">
				      <a class="page-link" href="#">&raquo;</a>
				    </li>
				  </ul>
				</div>
		<?php } ?>
			</div>
			<?php include('left.php'); ?>
		</div>
	</div>

<?php include('footer.php'); ?>