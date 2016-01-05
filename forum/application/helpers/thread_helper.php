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

	function checkTA($idCategory, $categoryUser){
		foreach($categoryUser as $cu){
			if($idCategory == $cu->category_id){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	function checkTopic($idTopic, $userTopics){
		$ounter = 0;
		foreach($userTopics as $top){
			if($top->id == $idTopic){
				$counter = $counter+1;
			}
		}
		if($counter > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function usersOption($users){
        foreach($users as $user){
            echo '<option value="'.$user->id.'">'.$user->full_name.'</option>';
        } 
	}

	function showThread($thr, $visitors, $comments, $threadMembers, $threadID, $userID){
		$counter = 0;
		foreach($threadMembers as $tm){
			if($tm->thread_id == $threadID AND $tm->user_id == $userID){
				$counter = $counter+1;
			}
		}
		if($counter > 0){
			echo "
				<tr>
                    <td>
                        <div class='thread-list-title'>
                            <h4>".anchor('thread/view/'.$thr->id, $thr->title)."
                                        <small class='label label-default'><i class='fa fa-lock'></i> Close Group</small>
                    		</h4>
                        </div>
                        <div class='thread-list-meta'>
                            <ul>
                                <li>
                                    ".countViewer($visitors, $thr->id)." Views
                                </li>
                                <li>
                                    ".countComments($comments, $thr->id)." Comments
                                </li>
                                <li>
                                    Started by <a href='#'>".user($thr->author)->full_name."</a>
                                </li>
                                <li>
                                    ".$thr->created_at."
                                </li>
                                <li>
                                    in <a href='#'>".$thr->category_name."</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
			";
		}else{
			
		}
	}