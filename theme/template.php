<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title><?=$page['title']?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    
    <link href="<?=DIRECTORY_THEME?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=DIRECTORY_THEME?>css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="<?=DIRECTORY_THEME?>css/font-awesome.min.css" rel="stylesheet">
    
    <link href="<?=DIRECTORY_THEME?>css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet">
    
    <link href="<?=DIRECTORY_THEME?>css/base-admin-3.css" rel="stylesheet">
    <link href="<?=DIRECTORY_THEME?>css/base-admin-3-responsive.css" rel="stylesheet">
    
    <link href="<?=DIRECTORY_THEME?>css/pages/dashboard.css" rel="stylesheet">

    <link href="<?=DIRECTORY_THEME?>css/custom.css" rel="stylesheet">

      <?=$page['styles']?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

<body>

<nav class="navbar navbar-inverse" role="navigation">

	<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Переключалка навигации</span>
      <i class="icon-cog"></i>
    </button>
    <a class="navbar-brand" href="<?=DIRECTORY?>">Библиотека</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <form class="navbar-form navbar-right" role="search">
      <div class="form-group">
        <input type="text" class="form-control input-sm search-query" placeholder="Якобы ''Поиск''">
      </div>
    </form>
  </div><!-- /.navbar-collapse -->
</div> <!-- /.container -->
</nav>
    



    
<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">
			
			<a href="javascript:;" class="subnav-toggle" data-toggle="collapse" data-target=".subnav-collapse">
		      <span class="sr-only">Переключалка навигации</span>
		      <i class="icon-reorder"></i>
		      
		    </a>

			<div class="collapse subnav-collapse">
				<ul class="mainnav">
				
					<li class="<?=isset($page['active']['home'])?"active":""?>">
						<a href="<?=DIRECTORY?>">
							<i class="icon-home"></i>
							<span>Главная</span>
						</a>	    				
					</li>

                    <li class="<?=isset($page['active']['books'])?"active":""?>">
                        <a href="<?=DIRECTORY?>?page=books">
                            <i class="icon-book"></i>
                            <span>Книги</span>
                        </a>
                    </li>

                    <li class="<?=isset($page['active']['authors'])?"active":""?>">
                        <a href="<?=DIRECTORY?>?page=authors">
                            <i class="icon-user"></i>
                            <span>Авторы</span>
                        </a>
                    </li>

                    <li class="<?=isset($page['active']['publishers'])?"active":""?>">
                        <a href="<?=DIRECTORY?>?page=publishers">
                            <i class="icon-android"></i>
                            <span>Издатели</span>
                        </a>
                    </li>

                    <li class="<?=isset($page['active']['genres'])?"active":""?>">
                        <a href="<?=DIRECTORY?>?page=genres">
                            <i class="icon-tags"></i>
                            <span>Жанры</span>
                        </a>
                    </li>

                    <li class="<?=isset($page['active']['readers'])?"active":""?>">
                        <a href="<?=DIRECTORY?>?page=readers">
                            <i class="icon-badge"></i>
                            <span>Читатели</span>
                        </a>
                    </li>

				</ul>
			</div> <!-- /.subnav-collapse -->

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
    
    
<div class="main">

    <div class="container">

      <?=$page['content']?>

    </div> <!-- /container -->
    
</div> <!-- /main -->
    


<div class="extra">

	<div class="container">

		<div class="row">
			
			<div class="col-md-3">
				
				<h4>About</h4>
				
				<ul>
					<li><a href="javascript:;">About Us</a></li>
					<li><a href="javascript:;">Twitter</a></li>
					<li><a href="javascript:;">Facebook</a></li>
					<li><a href="javascript:;">Google+</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
			<div class="col-md-3">
				
				<h4>Support</h4>
				
				<ul>
					<li><a href="javascript:;">Frequently Asked Questions</a></li>
					<li><a href="javascript:;">Ask a Question</a></li>
					<li><a href="javascript:;">Video Tutorial</a></li>
					<li><a href="javascript:;">Feedback</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
			<div class="col-md-3">
				
				<h4>Legal</h4>
				
				<ul>
					<li><a href="javascript:;">License</a></li>
					<li><a href="javascript:;">Terms of Use</a></li>
					<li><a href="javascript:;">Privacy Policy</a></li>
					<li><a href="javascript:;">Security</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
			<div class="col-md-3">
				
				<h4>Settings</h4>
				
				<ul>
					<li><a href="javascript:;">Consectetur adipisicing</a></li>
					<li><a href="javascript:;">Eiusmod tempor </a></li>
					<li><a href="javascript:;">Fugiat nulla pariatur</a></li>
					<li><a href="javascript:;">Officia deserunt</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
		</div> <!-- /row -->

	</div> <!-- /container -->

</div> <!-- /extra -->


    
    
<div class="footer">
		
	<div class="container">
		
		<div class="row">
			
			<div id="footer-copyright" class="col-md-6">
				&copy; 2017 romanamtv
			</div> <!-- /span6 -->
			
			<div id="footer-terms" class="col-md-6">
				Theme by <a href="http://jumpstartui.com" target="_blank">Jumpstart UI</a>
			</div> <!-- /.span6 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->
	
</div> <!-- /footer -->



    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=DIRECTORY_THEME?>js/libs/jquery-1.9.1.min.js"></script>
<script src="<?=DIRECTORY_THEME?>js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?=DIRECTORY_THEME?>js/libs/bootstrap.min.js"></script>

<script src="<?=DIRECTORY_THEME?>js/plugins/flot/jquery.flot.js"></script>
<script src="<?=DIRECTORY_THEME?>js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?=DIRECTORY_THEME?>js/plugins/flot/jquery.flot.resize.js"></script>

<script src="<?=DIRECTORY_THEME?>js/application_template.js"></script>

<script src="<?=DIRECTORY_THEME?>js/charts/area.js"></script>
<script src="<?=DIRECTORY_THEME?>js/charts/donut.js"></script>

<?=$page['scripts']?>

  </body>
</html>
