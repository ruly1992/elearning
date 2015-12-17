<?php 

	function countViewer($visitors, $idThread){
		$views = 0;
		    foreach ($visitors as $v) {
		        if($v->thread == $idThread){
		            $views = $views+1;
		        }
		    }
	    return $views;
	}

	function countComments($comments, $idThread){
		$sum_comments = 0;
	        foreach($comments as $c){
	            if($c->reply_to == $idThread){
	                $sum_comments = $sum_comments+1;
	            }
	        }
        return $sum_comments;
	}

	function countThreadCategories($threads, $category){
		$sum_categories = 0;
			foreach($threads as $t){
				if($t->category == $category){
					$sum_categories = $sum_categories+1;
				}
			}
		return $sum_categories;
	}