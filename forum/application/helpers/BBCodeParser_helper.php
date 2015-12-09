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
		'<3'=> asset('/emoticons/heart.png'),
		':('=> asset('/emoticons/sad.png'),
		':O'=> asset('/emoticons/shocked.png'),
		':P'=> asset('/emoticons/tongue.png'),
		';)'=> asset('/emoticons/wink.png'),
		':alien:'=> asset('/emoticons/alien.png'),
		':blink:'=> asset('/emoticons/blink.png'),
		':blush:'=> asset('/emoticons/blush.png'),
		':cheerful:'=> asset('/emoticons/cheerful.png'),
		':devil:'=> asset('/emoticons/devil.png'),
		':dizzy:'=> asset('/emoticons/dizzy.png'),
		':getlost:'=> asset('/emoticons/getlost.png'),
		':happy:'=> asset('/emoticons/happy.png'),
		':kissing:'=> asset('/emoticons/kissing.png'),
		':ninja:'=> asset('/emoticons/ninja.png'),
		':pinch:'=> asset('/emoticons/pinch.png'),
		':pouty:'=> asset('/emoticons/pouty.png'),
		':sick:'=> asset('/emoticons/sick.png'),
		':sideways:'=> asset('/emoticons/sideways.png'),
		':silly:'=> asset('/emoticons/silly.png'),
		':sleeping:'=> asset('/emoticons/sleeping.png'),
		':unsure:'=> asset('/emoticons/unsure.png'),
		':woot:'=> asset('/emoticons/w00t.png'),
		':wassat:'=> asset('/emoticons/wassat.png'),
		':whistling:'=> asset('/emoticons/whistling.png'),
		':love:'=> asset('/emoticons/wub.png')
	));

    return $parser->parse($text)
        ->detect_links()
        ->detect_emails()
        ->detect_emoticons()
        ->get_html();
}