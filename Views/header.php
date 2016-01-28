<html>
    <head>
        <title><?php echo $this->data['title']; ?></title>
        
        
        
        <script src="<?php echo $this->config['site_url']."/assets/plugins/jquery/jquery.js"; ?>"></script>
        
        <link rel="stylesheet" href="<?php echo $this->config['site_url']."/assets/plugins/jquery-ui/jquery-ui.css"; ?>" />
        <script src="<?php echo $this->config['site_url']."/assets/plugins/jquery-ui/jquery-ui.js"; ?>"></script>
        
        <link rel="stylesheet" href="<?php echo $this->config['site_url']."/assets/plugins/bootstrap/css/bootstrap.css"; ?>" />
        <script src="<?php echo $this->config['site_url']."/assets/plugins/bootstrap/js/bootstrap.js"; ?>"></script>
        
        <script> 
            var ajax_url = '<?php echo $this->config['site_url'].'/ajax/dispatch'; ?>';
            var ajax_token = '<?php echo $this->data['token']; ?>';
        </script>
        
        <script src="<?php echo $this->config['site_url']."/assets/js/main.js"; ?>"></script>
        <link rel="stylesheet" href="<?php echo $this->config['site_url']."/assets/css/style.css"; ?>" />
        
    </head>

<body>
    <div class="container">
        <div id="alerts"></div>
    </div>