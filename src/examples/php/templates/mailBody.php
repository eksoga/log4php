<?php ?>
<tr>
    <td><?=round(1000 * $event->getRelativeTime());?></td>
    <td title="<?=$event->getThreadName();?> thread"><?=$event->getThreadName();?></td>
    <td title="Level">
	<?php 
	$level = $event->getLevel();
	if ($level->equals(\LoggerLevel::getLevelDebug())) : ?>
	    <font color="#339933">$level</font>
        <?php elseif ($level->equals(\LoggerLevel::getLevelWarn())) : ?>
	    <font color="#993300"><strong><?=$level;?></strong></font>
        <?php else : ?>
	    <?=$level;?>
        <?php endif; ?>
    </td>
    <td title="<?=htmlentities($event->getLoggerName(), ENT_QUOTES);?> category">
	<?=htmlentities($event->getLoggerName(), ENT_QUOTES);?>
    </td>
    <?php if ($this->locationInfo) : ?>
	<?php $locInfo = $event->getLocationInformation(); ?>
	<td><?=htmlentities($locInfo->getFileName(), ENT_QUOTES). ':' . $locInfo->getLineNumber(); ?></td>
    <?php endif; ?>

    <td title="Message"><?=htmlentities($event->getRenderedMessage(), ENT_QUOTES);?></td>
</tr>

<?php if ($event->getNDC() != null) : ?>
    <tr>
	<td bgcolor="#EEEEEE" style="font-size : xx-small;" colspan="6" title="Nested Diagnostic Context">
	    NDC: <?=htmlentities($event->getNDC(), ENT_QUOTES);?>
	</td>
    </tr>
<?php endif;
