<?php

function BBCodeParser($text = null)
{
    $parser = new \SBBCodeParser\Node_Container_Document();

    if ($text == null){
        return $parser;
    }

    $parser->add_emoticons(array(
		':)'=> asset('plugins/sceditor/emoticons/smile.png'),
		':angel:'=> asset('plugins/sceditor/emoticons/angel.png'),
		':angry:'=> asset('plugins/sceditor/emoticons/angry.png'),
		'8-)'=> asset('plugins/sceditor/emoticons/cool.png'),
		':&#039;('=> asset('plugins/sceditor/emoticons/cwy.png'),
		':ermm:'=> asset('plugins/sceditor/emoticons/ermm.png'),
		':D'=> asset('plugins/sceditor/emoticons/grin.png'),
		'<3'=> asset('plugins/sceditor/emoticons/heart.png'),
		':('=> asset('plugins/sceditor/emoticons/sad.png'),
		':O'=> asset('plugins/sceditor/emoticons/shocked.png'),
		':P'=> asset('plugins/sceditor/emoticons/tongue.png'),
		';)'=> asset('plugins/sceditor/emoticons/wink.png'),
		':alien:'=> asset('plugins/sceditor/emoticons/alien.png'),
		':blink:'=> asset('plugins/sceditor/emoticons/blink.png'),
		':blush:'=> asset('plugins/sceditor/emoticons/blush.png'),
		':cheerful:'=> asset('plugins/sceditorplugins/sceditor/emoticons/cheerful.png'),
		':devil:'=> asset('plugins/sceditor/emoticons/devil.png'),
		':dizzy:'=> asset('plugins/sceditor/emoticons/dizzy.png'),
		':getlost:'=> asset('plugins/sceditor/emoticons/getlost.png'),
		':happy:'=> asset('plugins/sceditor/emoticons/happy.png'),
		':kissing:'=> asset('plugins/sceditor/emoticons/kissing.png'),
		':ninja:'=> asset('plugins/sceditor/emoticons/ninja.png'),
		':pinch:'=> asset('plugins/sceditor/emoticons/pinch.png'),
		':pouty:'=> asset('plugins/sceditor/emoticons/pouty.png'),
		':sick:'=> asset('plugins/sceditor/emoticons/sick.png'),
		':sideways:'=> asset('plugins/sceditor/emoticons/sideways.png'),
		':silly:'=> asset('plugins/sceditor/emoticons/silly.png'),
		':sleeping:'=> asset('plugins/sceditor/emoticons/sleeping.png'),
		':unsure:'=> asset('plugins/sceditor/emoticons/unsure.png'),
		':woot:'=> asset('plugins/sceditor/emoticons/w00t.png'),
		':wassat:'=> asset('plugins/sceditor/emoticons/wassat.png'),
		':whistling:'=> asset('plugins/sceditor/emoticons/whistling.png'),
		':love:'=> asset('plugins/sceditor/emoticons/wub.png')
	));

    return $parser->parse($text)
        ->detect_links()
        ->detect_emails()
        ->detect_emoticons()
        ->get_html();
}