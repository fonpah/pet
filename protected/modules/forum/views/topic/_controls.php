<ul class="topic-controls">
	
	<li>
		<?php $this->widget('zii.widgets.jui.CJuiButton',
				array(
					'name'=>'creat_topic'.$class,
						'caption'=>Yii::t('forum','Create Topic'),
					'value'=>'topic_',
					'buttonType'=>'link',
					'onclick'=>'js:function(){ window.location="'. Yii::app()->createUrl('//forum/topic/create',array('forum_id'=>$forum->id)).'"}',
					)
			); ?>
	</li>
	<li>
		<?php $this->widget('zii.widgets.jui.CJuiButton',
				array(
					'name'=>'subscribe_'.$class,
						'caption'=>Yii::t('forum','Subscribe'),
					'value'=>'subscribe',
					'buttonType'=>'checkbox',
					'onclick'=>'js:function(){alert("Save button clicked"); this.blur(); return false;}',
					)
			); ?>
	</li>
</ul>