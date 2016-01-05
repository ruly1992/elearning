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

	function countThreadCategories($threads, $category, $sumCloseThreads){
		$sum_threads = 0;
			foreach($threads as $t){
				if($t->category == $category AND $t->type == 'public'){
					$sum_threads = $sum_threads+1;
				}
			}

			foreach($sumCloseThreads as $closeThreads){
				foreach($closeThreads as $key => $value){
					if($category == $key){
						$sum_threads += $value;
					}
				}
			}
		return $sum_threads;
	}

	function countThreadsAD($threads, $category){
		$sum_threads = 0;
			foreach($threads as $t){
				if($t->category == $category AND $t->type == 'public'){
					$sum_threads = $sum_threads+1;
				}
			}
		return $sum_threads;
	}

	function countThreads($threads, $sumCloseThreads){
		$sum_threads = 0;
			foreach($threads as $t){
				if($t->type == 'public'){
					$sum_threads = $sum_threads+1;
				}
			}
			foreach($sumCloseThreads as $closeThreads){
				foreach($closeThreads as $key => $value){
					$sum_threads += $value;
				}
			}
		return $sum_threads;
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

	function sumCloseThread($threadMembers, $threadID, $userID)
	{
		$counter = 0;
		foreach($threadMembers as $tm){
			if($tm->thread_id == $threadID AND $tm->user_id == $userID){
				$counter = $counter+1;
			}
		}
		return $counter;
	}

	function showThread($thr, $visitors, $comments, $threadMembers, $threadID, $userID)
	{
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