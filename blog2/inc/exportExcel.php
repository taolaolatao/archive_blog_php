<?php 
	include('./connect.php');
	include('fw.php');
	
	$conn = new Connection();
	header('Content-Type: text/html; charset=utf-8');
	$data = $conn->getAllData('product');
	if($data)
	{
		$output = '
			<table class="table table-hover" border="1">
				<thead>
					<tr col="5">
						<h1 align="center"> Danh sách sản phẩm </h1>
					</tr>
					<tr>
						<th>ID</th>
						<th>NAME</th>
						<th>IMAGE</th>
						<th>PRICE</th>
						<th>UNIT</th>
					</tr>
				</thead>
			<tbody>
		';
		foreach ($data as $key => $value) {
			$output .= "
				<tr class='table-danger'>
					<td>{$value->ID}</td>
					<td>{$value->NAME}</td>
					<td>{$value->IMAGE}</td>
					<td>{$value->PRICE}</td>
					<td>{$value->UNIT}</td>
				</tr>
			";
		}
		$output .= '
			</tbody>
		</table>';

		header('Content-Type: application/xls');
		header('Content-Disposition: attachment; filename=listProduct.xls');
		echo $output;
	}
	else
	{
		echo 'Export File Excel False';
	}
?>