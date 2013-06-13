<?php defined('BASEPATH') OR exit('No direct access.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/iui/iui.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/iui/t/default/default-theme.css" type="text/css"/>
<script type="application/x-javascript" src="<?php echo base_url(); ?>assets/iui/iui.js"></script>

    <title>Time Tracker</title>
</head>
<body>
    <div class="toolbar">
        <h1 id="pageTitle"></h1>
         <a id="backButton" class="button" href="#"></a>
        <?php if($this->session->userdata('validated')): ?>
        <a class="button" target="_webapp" href="<?php echo base_url(); ?>index.php/login/logout/">Logout</a>
        <?php endif; ?>
    </div>
