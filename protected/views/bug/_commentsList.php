<?php if (!empty($comments)) : ?>
        <?php $i=0; ?>
        <?php foreach($comments as $comment): ?>
	        <?php
	            $access_del = null;
	            if( !empty($comment->user) && (Yii::app()->user->id == $comment->user->user_id) ){
					$access_del = array("className"=>"access_del","comment_id"=>$comment->comment_id);
				}
            ?>
            <li class="photo thumb comment-thumb"<?php echo isset($access_del) ? " access_del=\"" . $access_del['comment_id'] . "\"" : "" ?>>
                <?php
				if(!empty($comment->user)) {
                    echo CHtml::link(
                        '<img src="'.$comment->user->getImageSrc(31,31).'" class="bug-profile-pic" />',
                        array('user/view', 'id'=>$comment->user->user_id)
                    );
				}
                else{
                    echo '<img src="'. ImageHelper::thumb( 31, 31, 'images/profile_img/default.jpg', 85 ).'" class="bug-profile-pic" />';
                }
                ?>
            </li>
            <li class="body-comment <?php echo isset($access_del) ? $access_del['className'] : "" ?>" id="comment-<?php echo ++$i; ?>"<?php echo isset($access_del) ? " access_del=\"" . $access_del['comment_id'] . "\"" : "" ?>>
				<?php if(!empty($comment->user)) { ?>
                <span class="name"><?php echo $comment->user->name . ' ' . $comment->user->lname; ?>:</span>
				<?php }
                      else{
                          echo '<span class="name">' . Yii::t('main', 'Deleted') . ':</span>';
                      }
                ?>
                <span class="date"><?php echo Helper::formatDateLongWithTime($comment->created_at); ?></span>
                <br />
                <div class="commentBlock">
                    <div class="commentMessageFull">
                        <?php echo nl2br($comment->message); ?>
                    </div>
                </div>
            </li>
            <div class="clear"></div>
        <?php endforeach; ?>
<?php endif; ?>
