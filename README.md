SeoHider
========

Суть метода:
http://www.seowind.ru/vnutrennyaya-optimizaciya/seohide/

Использование виджета:

1) Закинуть папку SeoHider в your_yii_project/protected/extensions/ (например)

2) во вью скрывать любой блок так: 

<?php $this->beginWidget("ext.SeoHider.SeoHider", array('hashstring'=>'unique_id')); ?>
     
     [YOUR CONTENT BLOCK]
     
<?php $this->endWidget(); ?>


PS: requires jQuery
