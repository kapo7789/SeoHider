<?php
    class SeoHider extends CWidget {
        public $hashstring = 'AAA0';
        private $plainText;
        private $encryptedText;

        private function startJs() {

            $assets = dirname(__FILE__).'/resources';
            $baseUrl = Yii::app()->assetManager->publish($assets);
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/base64.js', CClientScript::POS_HEAD);
        }

        private function endJs() {
            Yii::app()->clientScript->registerScript("encoder",
                "
                var seoContent = {\"{$this->hashstring}\":\"{$this->encryptedText}\"};

                
                $('[hashstring]').each(function(){
                    var key = $(this).attr(\"hashstring\");
                    
                    if($(this).attr(\"hashtype\") == 'href'){
                        $(this).attr('href', Base64.decode(seoHrefs[key]));
                    }else{
                        var content = Base64.decode(seoContent[key]);
                        $(this).replaceWith(content);
                    }

                });

                ", CClientScript::POS_END);
        }
        
        public function init() {
            $this->startJs();
            ob_start();
        }
        
        public function run() {
            $this->plainText = ob_get_clean();
            $this->encryptedText = base64_encode($this->plainText);
            
            $this->renderResult();
        }

        private function renderResult() {
             echo "<span hashstring='{$this->hashstring}' hashtype='content'>&nbsp</span>";
             $this->endJs();
        }


        
    }
?>
