<?php defined('BASEPATH') OR exit('No direct access.'); ?>

<?php date_default_timezone_set('America/New_York'); ?>

<?php if(!isset($inside)) { $this->load->view('header'); } ?>

<ul id="screen1" title="Dashboard" <?php if(!isset($time_in) && !isset($time_out) && !isset($error)) { echo 'selected="true"'; } ?> >
    <li class="group">Welcome, <?php echo $this->session->userdata('fname'); ?></li>
    <li><a href="<?php echo base_url(); ?>index.php/timetrack/time_in/">Clock In</a></li>
    <li><a href="<?php echo base_url(); ?>index.php/timetrack/time_out/">Clock Out</a></li>
    <li><a href="<?php echo base_url(); ?>index.php/timetrack/history/">History</a></li>

<?php if($this->session->userdata('id') == '1'): ?>

    <!-- Administrator -->
    <li><a href="<?php echo base_url(); ?>index.php/admin/">Admin</a></li>
    <li><a href="#screen_debug">Debug</a></li>

<?php endif; ?>

</ul>

<div id="screen2" title="Clock In" <?php if(isset($time_in) && !isset($time_out)){ echo 'selected="true"'; } ?> >
<p>You have clocked in at <b><?php if(isset($time_in)) { echo date("d/m/y h:i:sA", $time_in); } ?></b>.</p>
<!-- hidden for UX
<a class="grayButton" href="<?php echo base_url(); ?>dashboard/">Main Dashboard</a>
-->
</div>

<div id="screen3" title="Clock Out" <?php if(isset($time_out)){ echo 'selected="true"'; }?> >
<p>You have clocked out at <b><?php if(isset($time_out)) {echo date("d/m/y h:i:sA", $time_out);} ?></b></p>
<!-- hidden for UX
<a class="grayButton" href="<?php echo base_url(); ?>dashboard/">Main Dashboard</a>
-->
</div>

<div id="screen_error" title="Error!" class="panel" <?php if(isset($error)){ echo 'selected="true"'; }?> >
<fieldset>
<div class="row">
<p><font color="red"><?php if(isset($error)) {echo $error;} ?></font></p>
</div>
</fieldset>
<!-- Hidden due to UX reasons...
<a class="whiteButton" href="<?php echo base_url(); ?>index.php/timetrack/time_in/">Clock In</a>
<br><br>
<a class="redButton" href="<?php echo base_url(); ?>index.php/timetrack/time_out/">Clock Out</a>
-->
</div>

<div id="screen_debug" title="Debug">
    <?php
    foreach($this->session->all_userdata() as $key => $val) {
        echo '<b>'.$key.':</b> '.$val.'<br>';
    }

    if(isset($error)) { echo 'Yes, theres an error: '.$error.'<br>'; }
    if(isset($inside)) { echo 'Inside is set: '.$inside.'<br>'; }
    ?>
</div>

<?php if(!isset($inside)) { $this->load->view('footer'); } ?>
