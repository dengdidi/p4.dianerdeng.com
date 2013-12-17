<!DOCTYPE html>
<html>
<head>

    <title><?php if(isset($title)) echo $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
    <link href="/css/styles.css" rel="stylesheet" type="text/css">              
    
</head>

<body>  


    <div id="menu">
  
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/index.php'> | Home</a>
            <a href='/index/shop'> | Shopping List</a> 
            <a href='/posts/add'> | Share Deal</a>  
            <a href='/posts/index'> | Deal Stream</a>  
            <a href='/posts/users'> | ChipperClippers</a> 
            <a href='/users/logout'> | Logout |</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>
            <a href='/index.php'> | Home</a>
            <a href='/users/error'> | Shopping List</a> 
            <a href='/users/error'> | Share Deal</a>  
            <a href='/users/error'> | Deal Stream</a>  
            <a href='/users/error'> | ChipperClippers |</a> 

        <?php endif; ?>
 
    </div>

    <br>
        
    
    <div id="content">
        <?php if(isset($content)) echo $content; ?>
    </div>

    <br>

    <div id="footer">
        <p>&copy;2013 Diane Deng | HARVARD DWA15 | Project 4: ChipperClipper for Couponers</p>
    </div>

</body>
</html>