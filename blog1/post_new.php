<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 row-post-search">
			<?php
				$limit = 4;

				if(isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range' => 1)))
				{
					$page = $_GET['page'];
					$one_page = ($page - 1) * $limit;
					$query_post_new = "SELECT * FROM category_post ORDER BY sap_xep ASC LIMIT {$one_page}, {$limit}";
				}
				else
				{
					$page = 0;
					$query_post_new = "SELECT * FROM category_post ORDER BY sap_xep ASC LIMIT {$page}, {$limit}";
				}

				
				$execute_post_new = mysqli_query($connect, $query_post_new) or die("Query: $query_post_new <br />" . 'Error: ' . mysqli_error($connect));

				while ($cate_new = mysqli_fetch_array($execute_post_new)) {
			?>
				<article>
					<div class="row row-post">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<img class="img-responsive"  src="<?php 
								$src = $cate_new['anh'];
									echo substr($src, 1, strlen($src) - 1);
							?>">
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<h3 class="media-heading"> 
								<a href="./detail_post.php?id=<?php echo $cate_new['id']; ?>&dm=<?php echo $cate_new['danh_muc']; ?>"> <?php echo $cate_new['tieu_de']; ?> </a> 
							</h3>
							<p>
								<details>
									<small>
										<time><?php echo $cate_new['ngay_dang']; ?></time>
										&nbsp;<time><?php echo $cate_new['gio_dang']; ?></time>
									</small>
								</details>
							</p>
							<p>
								<small>
									<figcaption class="description">
										<?php echo $cate_new['mo_ta']; ?>
									</figcaption>
								</small>
							</p>
						</div>
					</div> 
				</article>
			<?php
				}
			?>
			<ul class="pagination">
				<li class="previous" style="<?php if(!isset($_GET['page']) or $_GET['page'] == 1) echo 'display: none';  ?>">
					<a href="./index.php?page=<?php if(isset($_GET['page']) && $_GET['page'] > 0) $previous = $_GET['page']; echo --$previous; ?>">Previous</a>
				</li>
				<?php
					$get_post_total = mysqli_query($connect, "SELECT id FROM category_post");
					$num_result = mysqli_num_rows($get_post_total);
					$number_page = ceil($num_result / $limit);
					for ($i = 1; $i <= $number_page; $i++) { 
				?>
						<li class="<?php if(!isset($_GET['page']) && $i == 1) echo 'active'; ?>">
							<a href="index.php?page=<?php echo $i; ?>">
								<?php echo $i; ?>	
							</a>
						</li>
				<?php
					}
				?>
				<li class="next" style="<?php if($_GET['page'] == ($number_page)) echo 'display: none'; ?>">
					<a href="./index.php?page=<?php if(!isset($_GET['page'])){echo 2;}elseif(isset($_GET['page'])){$next = $_GET['page']; echo ++$next;} ?>">Next</a>
				</li>
			</ul>
		</div>
		<script type="text/javascript">
			<?php
				if (isset($_GET['page'])) {
					$active = $_GET['page'];
			?>
					$('ul.pagination li:nth-child(' + <?php echo (++$active); ?> + ')').addClass('active');
			<?php
				}
			?>
			$('input[type="text"]#txt-search').keyup(function(){
				let val = $(this).val();
				if(val !== '')
				{
					$.post('./another/ajax_search_post.php', { title : val }, function(data){
						$('.row-post-search').html(data);
					});
				}
				else
				{
					$('.row-post-search').empty();
				}
			});
		</script>