<?php
elgg_reset_notificaciones(elgg_get_logged_in_user_guid());
?>
<?php if ($vars['notifications']): ?>
    <?php foreach ($vars['notifications'] as $notify): ?>
        <div class="notifications_content_item_all">
            <div class="row">
                <span class="notification_icon_all">
                    <?php
                    $from_entity = get_entity($notify->from_guid);
                    if (!$from_entity) {
                        $from_entity=  elgg_get_logged_in_user_entity();
                    }
                    ?>
                    <img src="<?php
                    try {
                        echo $from_entity->getIconURL('small');
                    } catch (Exception $e) {
                        
                    };
                    ?>"/>

                </span></div>
            <div class="row" style="width: 325px; margin-left: 10px; ">
                <div style="min-height: 40px;">
                    <span class="notification_message_all">
                        <?php echo $notify->description ?>
                    </span>
                </div>
                <div style="vertical-align: bottom; text-align: right;width: 100%; margin-right: 10px;"><p class="notification_timeago">
            <?php echo elgg_view_friendly_time($notify->time_created) . "&nbsp;&nbsp;" ?>
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
    <div class="notifications_content_item_all" style="text-align: center;"><a href="<?php echo elgg_get_site_url() . "live_notifications/notificaciones"; ?>">Ver todas</a></div>
<?php else: ?>
    <div class="notifications_content_item_all">
        <p><?php echo elgg_echo('live_notifications:none'); ?></p>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        $("#item-notification").live('click', function() {
            location.href = $(this).attr('name');
        })
    })
</script>