
<!DOCTYPE html>
<html lang="hi" xmlns="http://www.w3.org/1999/xhtml">

<head><meta http-equiv="Content-Language" content="hi" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" /><meta name="author" /><link rel="icon" href="../../favicon.ico" /><title>
	SkillsHaat
</title>

    

   <?php
        echo $this->Html->css(array( 'staticpagecss/css/bootstrap.min.css', 'staticpagecss/css/custom.css'));
        echo $this->Html->script(array('staticpagecss/js/jquery.min.js', 'staticpagecss/js/bootstrap.min.js'));
    
    ?>
</head>
<body>

        <header>
             <div class="mainmenu1">			
                <nav class="navbar navbar-default">
                    <div class="container-custom">
                        <div class="navbar-header">
							 <a class="navbar-brand" href="index.aspx"><img class="img-responsive" src="<?php echo WEBSITE_URL; ?>admin/img/logo3.jpg" alt=""/></a>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                    <!--/.container-fluid -->
                </nav>
            </div>

        </header>
        <div class="footer-space"></div>
        
		<div class="top-space"></div>
        
    
    <?php echo $this->fetch('content'); ?>

        
        <div class="footer-space"></div>
        

</body>
</html>
