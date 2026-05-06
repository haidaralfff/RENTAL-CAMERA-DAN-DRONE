<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div style="border:1px solid #990000;padding:20px;margin:20px 0;font-family:sans-serif;">
	<h4 style="margin:0 0 10px 0;">A PHP Error was encountered</h4>
	<p>Severity: <?php echo $severity; ?></p>
	<p>Message:  <?php echo $message; ?></p>
	<p>Filename: <?php echo $filepath; ?></p>
	<p>Line Number: <?php echo $line; ?></p>
</div>
