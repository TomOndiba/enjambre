<h2 class="title-legend" style="margin-top: 20px;margin-left: 50px;">Noficicaciones</h2>

<?php if ($vars['notifications']): ?>
    <?php foreach ($vars['notifications'] as $notify): ?>
        <div class="notifications_content_item_all-2">
            <div class="row">
                <span class="notification_icon_all">
                    <?php $from_entity = get_entity($notify->from_guid); ?>
                    <img src="<?php echo $from_entity->getIconURL('small') ?>"/>

                </span></div>
            <div class="row" style="width: 90%;margin-left: 10px; ">
                <div style="min-height: 40px;">
                    <span class="notification_message_all" style="color: black;">
                        <?php echo $notify->description ?>
                    </span>
                </div>
                <div style="vertical-align: bottom; text-align: right;width: 100%; margin-right: 10px;"><p class="notification_timeago">
                        <?php echo elgg_view_friendly_time($notify->time_created)."&nbsp;&nbsp;" ?>
                    </p></div>
            </div>
            <?php if ($notify->read != 1): ?>
                <?php
                $notify->read = 1;
                $notify->save();
                ?>
            <?php endif; ?>
        </div>
    <?php endforeach ?>
<?php else: ?>
    <div class="notifications_content_item_all">
        <p><?php echo elgg_echo('live_notifications:none'); ?></p>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function(){
        $("#item-notification").live('click', function(){
           location.href= $(this).attr('name');
        })
    })
</script>