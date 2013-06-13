<?php if( ! defined('BASEPATH')) exit('No direct access.');
/* Author: Cam Tyler
 * Desc:   Login View
 */
?>
<form id="login_page" title="<?php echo $title; ?>" class="panel" name="tt_login" action="<?php echo base_url();?>index.php/login/process" method="post" selected="true">
    <fieldset>
        <?php if(isset($error)): ?>
        <div class="row">
            <p>
            <font color="red">
                <?php echo $error; ?>
            </font>
            </p>
        </div>
        <?php endif; ?>

        <?php if(isset($message)): ?>
        <div class="row">
            <p>
                <font color="green">
                    <?php echo $message; ?>
                </font>
            </p>
        </div>
        <?php endif; ?>


        <div class="row">
            <label>Employee ID</label>
            <input type="text" name="username" placeholder="Your Employee ID">
        </div>
        <div class="row">
            <label>PIN #</label>
            <input type="password" name="password" placeholder="Your PIN">
        </div>
    </fieldset>
    <a class="whiteButton" href="javascript:tt_login.submit()">Log me in!</a>
</form>
