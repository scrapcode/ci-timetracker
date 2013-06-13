<?php defined('BASEPATH') OR exit('No direct access.'); ?>

<?php date_default_timezone_set('America/New_York'); ?>

<div id="history_screen" title="History" class="panel">

<?php
// print_r($history); // Debug
if(isset($history['error'])): ?>

    <fieldset>
        <div class="row">
            <p><?php echo $history['error']; ?></p>
        </div>
    </fieldset>

<?php else: ?>

        <?php foreach($history as $row): ?>

        <fieldset>
            <div class="row">
                <b>IN:</b> <?php if(isset($row['time_in'])) { echo date("m/d/y h:i:sA", $row['time_in']);} ?> 
            </div>
            <div class="row">
                <b>OUT:</b> <?php if(isset($row['time_out']) && $row['time_out'] !== '') { echo date("m/d/y h:i:sA", $row['time_out']); } ?>
            </div>
        </fieldset>

    <?php endforeach; ?>

<?php endif; ?>
</div>
