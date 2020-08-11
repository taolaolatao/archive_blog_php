<?php
/* 
Thêm đoạn code này vào đầu website
<?php
require("chongddos.php");
?> 
*/
	$gioihan = 5;
	if(!isset($_SESSION['chong_ddos'])){
		session_start();
	}
	if((time() - $_SESSION['chong_ddos-'.$url_ddos]) <= $gioihan){
		$url_ddos = sha1($_SERVER['REQUEST_URI']);

	if((time() - $gioihan) < $_SESSION['chong_ddos-'.$url_ddos] && 
		$url_ddos == $_SESSION['url_ddos-'.$url_ddos]){
		$_SESSION['chong_ddos-'.$url_ddos] = time();
?>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700|Roboto+Condensed:300,400,700">
		<link rel="stylesheet" href="https://vufun.top/upfile/assets/css/phucvu-style.css">
		<div class="page">
			<div class="page-content">
				<div class="container text-center text-dark">
				    <img src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://i.imgur.com/5Mp7OWN.png" style="width:150px"/>
					<div class="display-2 text-dark mb-5">CẢNH BÁO</div>
					<p class="h4 font-weight-normal mb-7 leading-normal">Oops...! Bạn thao tác quá nhanh, vui lòng thao tác chậm lại</p>
					<a class="btn btn-primary  mb-5" href="/">
						Quay lại trang chủ
					</a>
				</div>
			</div>
		</div>
<?php
			exit;
		}
	}

	$_SESSION['chong_ddos-'.$url_ddos] = time();
	$_SESSION['url_ddos-'.$url_ddos] = $url_ddos;
?>