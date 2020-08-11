<?php
	require('../another/connect.php');
	require('../another/func.php');
	require('./header.php');
?>

<div class="main">
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<legend> <h2> Danh sách danh mục </h2> </legend>
				<table class="table table-hover tb-list-cate">
					<thead>
						<tr>
							<th> ID </th>
							<th> TÊN DANH MỤC </th>
							<th> PARENT </th>
							<th> MENU </th>
							<th> HOME </th>
							<th> TRẠNG THÁI </th>
							<th> XÓA </th>
							<th> SỬA </th>
						</tr>
					</thead>
					<tbody>
						<?php
							list_category();
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>