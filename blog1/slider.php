<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div id="carousel-id" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carousel-id" data-slide-to="0" class="active"></li>
				<?php
					$query_count_img = "SELECT COUNT(id) FROM image_post WHERE status = 1";
					$execute_count_img = mysqli_query($connect, $query_count_img);
					list($records) = mysqli_fetch_array($execute_count_img); 
					$count = 0;
					while($count < $records)
					{
						$count++;
				?>
					<li data-target="#carousel-id" data-slide-to="<?php echo $count; ?>"></li>
				<?php
					}
				?>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<img style="width: 100%; height: 500px; max-width: 100%;" alt="First slide" src="./images/main/default_slider.png">
				</div>
				<?php

					$query_get_img = "SELECT * FROM image_post WHERE status = 1";
					$execute_get_img = mysqli_query($connect, $query_get_img);
					if(mysqli_num_rows($execute_get_img) > 0)
					{
						while($anh = mysqli_fetch_array($execute_get_img))
						{
				?>
					<div class="item">
						<img style="width: 100%; height: 500px; max-width: 100%;" alt="First slide" src="<?php $len = $anh['anh']; echo substr($len, 1, strlen($len) - 1); ?>">
					</div>
				<?php
						}
					}

				?>
			</div>
			<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>
</div>