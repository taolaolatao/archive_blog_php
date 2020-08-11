<?php
	define('BASE_URL', 'http://vhmblog.com/');
	define('BASE_URL_HOST', 'http://vhmblog.byethost33.com');
	function show_category($parent_id = '0', $insert_text = "")
	{
		global $connect;
		$query_recursive = "SELECT * FROM menu WHERE parent_id = ".$parent_id." ORDER BY parent_id DESC";
		$execute_query_recursive = mysqli_query($connect, $query_recursive);
		while($category = mysqli_fetch_array($execute_query_recursive, MYSQLI_ASSOC))	
		{
?>
			<option value="<?php echo $category['ID']; ?>"> <?php echo $insert_text . $category['danhmuc_baiviet']; ?> </option>
<?php
			show_category($category['ID'], html_entity_decode("&nbsp; &nbsp; &nbsp;") . ' +');
		}
	}

	function select($name, $class)
	{
		global $connect;
?>
		<select name="<?php echo $name; ?>" class="<?php echo $class; ?>">
			<option value="0" style="font-weight: bold"> Danh mục cha </option>
			<?php show_category(); ?>
		</select>
<?php
	}

	function menu($parent_id = '0', $dem = 0)
	{
		global $connect;
		$cate_child = array();
		$query_cate = "SELECT * FROM menu WHERE parent_id = {$parent_id} ORDER BY ordernum DESC";
		$execute_cate = mysqli_query($connect, $query_cate);
		while ($categories = mysqli_fetch_array($execute_cate, MYSQLI_ASSOC)) {
			$cate_child[] = $categories;
		}
		if($cate_child)
		{
			echo '<ul class="animated">';

			foreach ($cate_child as $key => $value) {
				if($dem === 0)
				{
					echo "<li class='active'> <a href='http://vhmblog.com/'>" . $value['danhmuc_baiviet'] . "</a>";
					// echo "<li class='active'> <a href='http://vhmblog.byethost33.com/'>" . $value['danhmuc_baiviet'] . "</a>";
				}
				else{
					echo "<li> <a href='./post_by_category.php?dm=" . $value['ID'] ."'>" . $value['danhmuc_baiviet'] . "</a></span>";
				}
				menu($value['ID'], ++$dem);
				echo '</li>';
			}
			echo '</ul>';
		}
	}

	function list_category($parent_id = '0', $insert_text = '+&nbsp;')
	{
		global $connect;
		$cate_array = [];
		$query_categories = "SELECT * FROM menu WHERE parent_id = {$parent_id} ORDER BY parent_id DESC";
		$execute_categories = mysqli_query($connect, $query_categories);
		while($cate = mysqli_fetch_array($execute_categories, MYSQLI_ASSOC)) {
			$cate_array[] = $cate;
		}
		if($cate_array)
		{
			foreach ($cate_array as $key => $value) {
?>
				<tr>
					<td> <?php echo $value['ID']; ?> </td>
					<td> <?php echo $insert_text .  $value['danhmuc_baiviet']; ?></td>
					<td> 
						<?php 
							if($value['parent_id'] != 0) echo 'Danh mục Con';
							else echo 'Danh mục Cha';
						?> 
					</td>
					<td> 
						<?php
							if($value['menu'] == 1) echo 'Có';
							else echo 'Không';
						?>
					</td>
					<td> 
						<?php
							if($value['home'] == 1) echo 'Có';
							else echo 'Không';
						?>
					</td>
					<td> 
						<?php
							if($value['status'] == 1) echo 'Hiển thị';
							else echo 'Không hiển thị';
						?>
					</td>
					<td> <a onclick="return confirm('Bạn có muốn xóa không?');" href="../php/delete_category_2.php?id=<?php echo $value['ID']; settype($value['ID'], 'int'); ?>"> <i class="fa fa-trash-o"></i> </a> </td>
					<td> <a href="../php/edit_category_2.php?id=<?php echo $value['ID']; settype($value['ID'], 'int'); ?>"> <i class="fa fa-pencil-square"></i> </a> </td>
				</tr>
				<?php list_category($value['ID'], html_entity_decode('&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')); ?>
<?php
			}
		}
	}
?>