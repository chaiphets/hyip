<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>ForexDBLot - Reliable and Professional financial management</title>
	<meta name="description" content="Gold, HYIP, High Yield Invesmtent, High Yield Investments, High Yield Investment Program, Forex DB Lot, Residual Income, Online Investments, Market trends, Trading, Managed Account, Best Investment Program, the oldest investment program">
	<meta name="keywords" content="Gold, HYIP, High Yield Invesmtent, High Yield Investments, High Yield Investment Program, Forex DB Lot, Residual Income, Online Investments, Market trends, Trading, Managed Account, Best Investment Program, the oldest investment program">
	
	<link href="<?=base_url('lib/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('lib/bootstrap/css/datepicker3.css')?>" rel="stylesheet">
	<link href="<?=base_url('lib/jquery/plugins/spin/css/jquery.spin.css')?>" rel="stylesheet">
	<link href="<?=base_url('lib/jquery/plugins/trumbowyg/trumbowyg.min.css')?>" rel="stylesheet">
	
	<script type="text/javascript" src="<?=base_url('lib/jquery/jquery-1.11.1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('lib/bootstrap/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('lib/bootstrap/js/bootstrap-datepicker.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/spin/js/jquery.spin.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/trumbowyg/trumbowyg.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('lib/jquery/plugins/twbsPagination/twbsPagination.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('lib/javascript/intense.min.js')?>"></script>
	
	<style>
		.validation-error{
			color: #C84C64;
		}
		.spin{
			width: 16px;
			height: 16px;
			margin: 0;
		}
		.row{
			margin-top: 5px;
			margin-bottom: 5px;
		}
		.navbar{
			margin-bottom: 0px;
		}
		.panel{
			/*margin-bottom: 0px;*/
		}
		p{
			margin: 0 0 20px;
		}
	</style>
	<script>
		$(document).ready(function(){
			$('li','#nav-menu')
			.mouseenter(function(){
				$(this).addClass('active');
			})
			.mouseout(function(){
				$(this).removeClass('active');
			});
			
			var delayInit = 5000;
			var delayEach = 2000;
			$('.autoclose').each(function(){
				$(this).delay(delayInit).delay(delayEach).slideUp(500);
				delayEach *= 2;
			});
			$('.datepicker').datepicker({
			    format: "dd/mm/yyyy",
			    todayBtn: "linked",
			    autoclose: true,
			    todayHighlight: true
			});
			$('.spin').spin();
			$('.decimal').addClass('text-right');
			$('.decimal').change(function(){
				// var x = $(this).val();
				// $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				var num = parseFloat($(this).val());
				if(isNaN(num)){
					$(this).val('');
					return;
				}
		    	var new_num = $(this).val(num.toFixed(2));
			});
			$('th').addClass('text-center');
		});
	</script>
</head>
<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=site_url()?>">ForexDBLot.com</a>
    </div>
    
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right" id="nav-menu">
      	<li><a href="<?=site_url()?>">HOME</a></li>
      	<li><a href="#">SIGN UP</a></li>
      	<li><a href="#">LOGIN</a></li>
      	<li><a href="#">INVESTMENT PLAN</a></li>
      	<li><a href="<?=site_url('term')?>">TERMS</a></li>
      	<li><a href="#">F.A.Q</a></li>
      	<li><a href="#">SUPPORT</a></li>
      	<?php if($user):?>
        <!--li><a href="#">Meterial</a></li>
        <li><a href="#">Task</a></li-->
		<li><a href="<?=site_url('postmenu/postmenu')?>">Post your menu</a></li>
        <li><a href="<?=site_url('task/task')?>">My Task (<?=($tasks)?sizeof($tasks):0;?>)</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Expense<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=site_url('expense/raw_material')?>">วัตถุดิบ</a></li>
            <li><a href="<?=site_url('expense/material')?>">อุปกรณ์</a></li>
            <li><a href="<?=site_url('expense/misc')?>">จิปาถะ</a></li>
            <!--li><a href="<?=site_url('index.php/material/investment')?>">เงินทุน</a></li-->
            <!--li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li-->
          </ul>
        </li>
        <li><a href="<?=site_url('mom/mom')?>">Minute of Meeting</a></li>
        <?php endif;?>
      </ul>
      
      <!--ul class="nav navbar-nav navbar-right">
      	<?php if($user):?>
      	<li><p class="navbar-text">Sign in as <?=$user['first_name']?></p></li>
		<li><button type="button" class="btn btn-default navbar-btn" onclick="window.location='<?=site_url('authentication/authen/logout')?>'">Sign out</button></li>
		<?php else:?>
		<li><button type="button" class="btn btn-default navbar-btn" onclick="window.location='<?=site_url('authentication/authen/login')?>'">Sign in</button></li>
		<?php endif;?>
      </ul-->
      
    </div><!--/.nav-collapse -->
  </div>
</div>



<!--div class="container" style="margin-top: 60px"-->
<div class="container">