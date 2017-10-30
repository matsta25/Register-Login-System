<?php if (count($pass_stats) > 0): ?>
<div class="error">
<?php foreach ($pass_stats as $pass_stats): ?>
<p><?php echo $pass_stats; ?></p>
<?php endforeach; ?>
</div>
<?php endif; ?>