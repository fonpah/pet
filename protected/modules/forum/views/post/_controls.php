<ul class="post-controls">
	<li>
		<?php $this->widget('zii.widgets.jui.CJuiButton',
				array(
					'name'=>'Subscribe_'.$class,
						'caption'=>($subscribe>0?Yii::t('forum','UnSubscribe'):Yii::t('forum','Subscribe')),
					'value'=>'Subscribe',
					'buttonType'=>'checkbox',
					'id'=>'subscribe',
					'htmlOptions'=>array('checked'=>($subscribe>0?"checked":"unchecked")),
					'onclick'=>'js:function(){
						$.ajax({
							type:"post",
							url:"'.Yii::app()->createUrl('forum/subscription/create').'",
							data:{
								Subscription:{
									forum_id:"'.$topic->forum_id.'",
									user_id:"'.Yii::app()->user->getId().'",
									topic_id:"'.$topic->id.'",
									action: $("#subscribe").button("option","label")
									
									
								},
							  isAjax:1
							},
						 success:function(msg){
						 	 if(msg=="Unsubscribe"){
						 	 	$("#subscribe").button("option","label","'.Yii::t('forum', 'Unsubscribe').'").attr({checked:"checked"});
						 	 }
							else{
								$("#subscribe").button("option","label","'.Yii::t('forum', 'Subscribe').'").attr({checked:"unchecked"});
							}
						 }
						});
					}',
					)
			); ?>
	</li>
	<li>
		<?php $this->widget('zii.widgets.jui.CJuiButton',
				array(
					'name'=>'reply_'.$class,
						'caption'=>Yii::t('forum','Reply'),
					'value'=>'poll',
					'buttonType'=>'link',
					'onclick'=>'js:function(){window.location="'. Yii::app()->createUrl('//forum/post/create',array('forum_id'=>$topic->forum_id,'topic_id'=>$topic->id)).'"}',
					)
			); ?>
	</li>
</ul>
