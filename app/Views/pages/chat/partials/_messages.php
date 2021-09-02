<ul class="conversation-list" data-simplebar="init" style="max-height: 460px">
    <div class="simplebar-wrapper" style="margin: 0px -15px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                    <div class="simplebar-content" style="padding: 0px 15px;">
                        <?php if(count($messages) > 0): ?>
                            <?php foreach ($messages as $message): ?>
                            <?php if($message['chat_from_id'] == $auth_employee['employee_id'] && $message['chat_to_id'] == $selected_employee['employee_id']): ?>
                            <li class="clearfix odd">
                                <div class="chat-avatar">
                                    <img src="/assets/images/users/user-5.jpg" class="rounded" alt="James Z">
                                    <i>10:00</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i><?= $auth_employee['employee_f_name'] ?? '' ?> <?= $auth_employee['employee_l_name'] ?? '' ?></i>
                                        <p><?php $message['chat_message'] ?? '' ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                                <?php if($message['chat_to_id'] == $selected_employee['employee_id'] && $message['chat_from_id'] == $auth_employee['employee_id']): ?>
                                    <li class="clearfix">
                                        <div class="chat-avatar">
                                            <img src="/assets/images/users/user-5.jpg" class="rounded" alt="James Z">

                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i><?= $selected_employee['employee_f_name'] ?? '' ?> <?= $selected_employee['employee_l_name'] ?? '' ?></i>
                                                <p><?= $message['chat_message'] ?></p>
                                                <p><?= date('F j, Y g:i a', strtotime($message['created_at'])) ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center">Start a conversation</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 850px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar" style="height: 248px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
    </div>
</ul>