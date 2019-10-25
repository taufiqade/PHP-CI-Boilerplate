<!-- 
    this is base layout application
-->

<!DOCTYPE html>
<html lang="en">
  <head>

    <?php 
        echo $_views['head']; 
    ?>

  </head>

  <body class=" <?php echo isset($_views['body-class']) ? $_views['body-class'] : ''; ?>">
    
    <?php 
        if(isset($_views['header'])) {
            echo $_views['header']; 
        }
    ?>

    <div class="main-wrapper">
        <?php 
            if(isset($_views['menu'])) {
                echo $_views['menu']; 
            }
        ?>
        <div class="body-page <?php echo isset($_views['body-class']) ? $_views['body-class'] : ''; ?>">
        <?php 
            if(isset($_views['content'])) {
                echo (is_array($_views['content']) ? implode("",$_views['content']) : $_views['content']);	
            }
        ?>
        </div>
        <?php 
            if(isset($_views['footer'])) {
                echo $_views['footer']; 
            }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <?php
    if(isset($_js_bottom)) {
        $_js_bottom_list=[];
        if(is_array($_js_bottom)) {
            foreach($_js_bottom as $k=>$v) {
                if(!in_array($v, $_js_bottom_list)) {
                    if(strpos($v, '<script')!==false) {
                        echo $v;
                    } else {
                        echo '<script type="text/javascript" src="'.$v.'"></script>';
                    }
                    $_js_bottom_list[]=$v;
                }
            }
        } else {
            if(!in_array($_js_bottom, $_js_bottom_list)) {
                echo '<script type="text/javascript" src="'.$_js_bottom.'"></script>';
                $_js_bottom_list[]=$_js_bottom;
            }
        }
    }
    ?>
  </body>
</html>