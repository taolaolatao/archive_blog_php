<?php
	include('./head.php');
	// include('./slider.php');
	if((isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) && (isset($_GET['dm']) && filter_var($_GET['dm'], FILTER_VALIDATE_INT, array('min_range' => 1))))
	{
		$id = $_GET['id'];
		$dm = $_GET['dm'];
		$query_getcate = "SELECT ID, danhmuc_baiviet FROM menu WHERE ID = {$dm}";
		$execute_getcate = mysqli_query($connect, $query_getcate);
		$result_getcate = mysqli_fetch_assoc($execute_getcate);
		$query_getpost = "SELECT * FROM category_post WHERE id = {$id}";
		$execte_getpost = mysqli_query($connect, $query_getpost);
		$result_getpost = mysqli_fetch_assoc($execte_getpost);
		$view_add = $result_getpost['luot_xem'] += 1;
		$query_updateview = "UPDATE category_post SET luot_xem = {$view_add} WHERE id = {$id}";
		$execute_updateview = mysqli_query($connect, $query_updateview);
	}
	else
	{
		header('location: ./index.php');
		exit();
	}
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<main>
				<div class="content_post">
					<a href="<?php echo BASE_URL; ?>" class="a-link">
						<span class="glyphicon glyphicon-home"></span>
					</a>
					<a href="#" class="btn btn-link disabled"> / </a>
					<a href="#" class="a-link">
						<?php
							echo $result_getcate['danhmuc_baiviet'];
						?>
					</a>
				</div>
				<div class="content_post">
					<h1> <?php echo $result_getpost['tieu_de']; ?> 
						<h3>
							<small>
								<time> Ngày đăng: <?php echo $result_getpost['ngay_dang']; ?></time>
								&nbsp; &nbsp;
								<time> Giờ đăng: <?php echo $result_getpost['gio_dang']; ?></time>
								&nbsp; &nbsp;
								<time> Lượt xem: <?php if(isset($view_add)) echo $view_add; ?></time>
							</small>
						</h3> 
					</h1><br />
					
					<article>
						<p>
							<?php
								echo $result_getpost['noi_dung'];
							?>
						</p>
					</article>
				</div>
			</main> <hr />
			<aside class="comments">
			<?php
				$query_get_comments = "SELECT * FROM comments WHERE title = {$id}";
				$execute_get_comments = mysqli_query($connect, $query_get_comments);
				if(mysqli_num_rows($execute_get_comments) > 0)
				{
					while ($comments = mysqli_fetch_array($execute_get_comments)) {
			?>
						<div class="media">
						    <div class="media-left">
						      <img src="http://profilepicturesdp.com/wp-content/uploads/2018/06/avatars-for-profile-pictures-1.png" class="media-object" style="width:45px">
						    </div>
						    <div class="media-body">
						      <h4 class="media-heading"><?php echo $comments['hoten']; ?> 
						      <small><i><?php echo $comments['email']; ?></i></small></h4>
						      <p>
						      	<?php echo $comments['noi_dung']; ?>
						      </p>
						  	</div>
						</div>
			<?php
					}
				}
			?>
			</aside>
			<aside class="comments_post">
				<form action="" method="POST" role="form">
					<h2> <p> Bình luận </p></h2>
					<input type="hidden" name="title" id="title" value="<?php if(isset($id)) echo $id; ?>">
					<div class="form-group">
						<label> Họ tên </label>
						<input type="text" name="username" id="username_comment" class="form-control" required>
					</div>
					<div class="form-group">
						<label> Email </label>
						<input type="email" name="email" id="email_comment" class="form-control" required>
					</div>
					<div class="form-group">
						<label> Nội dung </label>
						<textarea class="form-control comments-content" id="content_comment" rows="5" required></textarea>
					</div>
				
					
				
					<button type="button" id="btn-send-comment" class="btn btn-primary">Gửi</button>
				</form>
			</aside>
			<aside class="post_related">
				<h2> <p> Tin liên quan </p></h2>
				<ul class="list-group">
					<?php
						$query_related_post = "SELECT * FROM category_post WHERE id != {$id} AND danh_muc = {$result_getcate['ID']} ORDER BY id DESC";
						$execute_related_post = mysqli_query($connect, $query_related_post);
						if(mysqli_num_rows($execute_related_post) > 0)
						{
							while($post_related = mysqli_fetch_array($execute_related_post))
							{
					?>
								<li class="list-group-item">
									<a href="./detail_post.php?id=<?php echo $post_related['id']; ?>&dm=<?php echo $post_related['danh_muc']; ?>"> 
										<?php 
											echo $post_related['tieu_de'];
										?> 
									</a>
								</li>
					<?php
							}
						}
					?>
					
				</ul>
			</aside>
			<aside class="post_random">
				<h2> <p> Tin ngẫu nhiên </p></h2>
				<ul class="list-group">
					<?php
						$query_post_random = "SELECT * FROM category_post ORDER BY rand() LIMIT 0, 5";
						$execute_post_random = mysqli_query($connect, $query_post_random);
						while($post_random = mysqli_fetch_array($execute_post_random))
						{
					?>
							<li class="list-group-item">
								<a href="./detail_post.php?id=<?php echo $post_random['id']; ?>&dm=<?php echo $post_random['danh_muc']; ?>"> 
									<?php 
										echo $post_random['tieu_de'];
									?> 
								</a>
							</li>
					<?php
						}
					?>
				</ul>
			</aside>
		</div>
		<script type="text/javascript">
			$('#btn-send-comment').click(function(){
				var valTitle = $('#title').val();
				var valName = $('#username_comment').val();
				var valEmail = $('#email_comment').val();
				var valContent = $('#content_comment').val();


				if(valTitle != '' && valName != '' && valEmail != '' && valContent != '')
				{
					$.ajax({
						type: 'POST',
						url: './another/ajax_comments.php',
						data: {
							title : valTitle, 
							name: valName, 
							email : valEmail, 
							content : valContent
						},
						cache: false,
						success: function(result){
							// $('aside.comments').append(result);
							alert("Comment đã được gửi: " + result);
						}
					})
				}
				else
				{
					alert('Bạn cần nhập đầy đủ các trường');
				}
				
			});
			
		</script>
<?php
	require('./right.php');
?>