				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<h3> <span class="label label-primary" title="Video mới nhất"> VIDEO MỚI NHẤT </span> </h3>
					<iframe class="emmbed-player" style="width: 100%; height: 270px" src="https://www.youtube.com/embed/5WN19l18Eo8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					<!-- Auto run when access website ?rel=0&autoplay=1 -->
					<button class="btn btn-danger mg-bt" data-toggle="collapse" data-target="#list_video"> Danh sách video </button>
					<div id="list_video" class="collapse in">
						<ul class="list-group">
						<?php
							$query_video = "SELECT * FROM video WHERE status = 1";
							$execute_video = mysqli_query($connect, $query_video);
							if(mysqli_num_rows($execute_video) > 0)
							{
								$count = 0;
								while ($link_video = mysqli_fetch_array($execute_video)) {
									$v = explode('=', $link_video['link']);
									$count++;
						?>
							 <li class="list-group-item list_link_video"> 
							 	<a href="#<?php echo $count; ?>" title="<?php echo $v[1]; ?>"><?php echo $link_video['tieu_de']; ?> </a>
							 </li> <br />
						<?php
								}
							}
						?>
						</ul>
					</div> <br /> <hr />	
					<section class="post_view_most">
						<h3> <span class="label label-primary" title="Tin xem nhiều nhất"> TIN XEM NHIỀU NHẤT </span> </h3>
						<button class="btn btn-danger mg-bt" data-toggle="collapse" data-target="#list_post_most"> Danh sách bài viết xem nhiều </button>
						<div id="list_post_most" class="collapse in">
							<ul class="list-group">
								<?php
									$query_post_most = "SELECT * FROM category_post ORDER BY luot_xem DESC LIMIT 0,8";
									$execute_post_most = mysqli_query($connect, $query_post_most);
									while($cate_most = mysqli_fetch_array($execute_post_most))
									{
								?>
									<li class="list-group-item list_link_video"> 
									 	<a href="./detail_post.php?id=<?php echo $cate_most['id']; ?>&dm=<?php echo $cate_most['danh_muc']; ?>"> 
									 		<?php echo $cate_most['tieu_de']; ?> 
									 	</a>
									 </li> <br />
								<?php
									}
								?>
							</ul>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript" src="./js/anime.js"></script>
	<script type="text/javascript" src="./js/index.js"></script>
	<script type="text/javascript" src="./js/particles.js-master/particles.js"></script>
	<script type="text/javascript" src="./js/particles.js-master/demo/js/app.js"></script>
</body>
</html>