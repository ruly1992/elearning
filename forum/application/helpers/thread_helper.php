<?php 

	function countViewer($visitors, $idThread)
	{
		$views = 0;
		    foreach ($visitors as $v) {
		        if($v->thread == $idThread){
		            $views = $views+1;
		        }
		    }
	    return $views;
	}

	function countComments($comments, $idThread)
	{
		$sum_comments = 0;
	        foreach($comments as $c){
	            if($c->reply_to == $idThread){
	                $sum_comments = $sum_comments+1;
	            }
	        }
        return $sum_comments;
	}

	function checkTopicsCategory($topics, $threads, $idCategory, $threadMembers, $userID)
	{
		$counter = 0;
		foreach($topics as $top){
			if($top->category == $idCategory){
				$countThreadsTopic	=	checkThreadsTopic($threads, $top->id, $threadMembers, $userID);
				if($countThreadsTopic > 0){
					$counter += 1;
				}
			}
		}
		return $counter;
	}

	function checkThreadsTopic($threads, $idTopic, $threadMembers, $userID)
	{
		$counter = 0;
		foreach($threads as $thr){
			if($thr->topic == $idTopic){
				if($thr->type == 'close' AND $thr->author != $userID){
					$close 	= sumCloseThread($threadMembers, $thr->id, $userID);
					$counter += $close;
				}else{
					$counter += 1;
				}
			}
		}
		return $counter;
	}

	function checkTopicsCategoryAuthor($topics, $threads, $idCategory)
	{
		$counter = 0;
		foreach($topics as $top){
			if($top->category == $idCategory){
				$countThreadsTopic	=	checkThreadsTopicAuthor($threads, $top->id);
				if($countThreadsTopic > 0){
					$counter += 1;
				}
			}
		}
		return $counter;
	}

	function checkThreadsTopicAuthor($threads, $idTopic)
	{
		$counter = 0;
		foreach($threads as $thr){
			if($thr->topic == $idTopic){
				$counter += 1;
			}
		}
		return $counter;
	}

	function countThreads($threads, $closeThreads)
	{
		$sum_threads = 0;
			foreach($threads as $t){
				if($t->type == 'public'){
					$sum_threads = $sum_threads+1;
				}
			}
			foreach($closeThreads as $cls){
				$sum_threads += 1;
			}
		return $sum_threads;
	}

	function countThreadsCategoryTA($threads, $topics, $idCategory, $closeThreads, $userID)
	{
		$sum_threads = 0;
			foreach($threads as $t){
				if($t->category == $idCategory AND $t->type == 'public'){
					$sum_threads += 1;
				}else{
					$tempThread = 0;
					foreach ($topics as $topic) {
						if($topic->tenaga_ahli == $userID AND $t->topic == $topic->id AND $t->category == $idCategory){
							$sum_threads += 1;
							$tempThread   = $t->id;
						}
					}
					foreach($closeThreads as $cls){
						if($t->id == $cls->id AND $t->category == $idCategory AND $t->id != $tempThread){
							$sum_threads += 1;
						}
					}
				}
			}
		return $sum_threads;
	}

	function countThreadsCategory($threads, $idCategory, $closeThreads)
	{
		$sum_threads = 0;
			foreach($threads as $t){
				if($t->category == $idCategory AND $t->type == 'public'){
					$sum_threads += 1;
				}else{
					foreach($closeThreads as $cls){
						if($t->id == $cls->id AND $t->category == $idCategory){
							$sum_threads += 1;
						}
					}
				}
			}
		return $sum_threads;
	}

	function countThreadsAD($threads, $category)
	{
		$sum_threads = 0;
			foreach($threads as $t){
				if($t->category == $category){
					$sum_threads = $sum_threads+1;
				}
			}
		return $sum_threads;
	}

	function checkTA($idCategory, $categoryUser)
	{
		foreach($categoryUser as $cu){
			if($idCategory == $cu->category_id){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	function checkTopic($idTopic, $userTopics)
	{
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

	function usersOption($users, $idUser)
	{
        foreach($users as $user){
        	if($user->id != $idUser){
	        	$role = 	$user->roles->pluck('name')->toArray();
	            echo '<option value="'.$user->id.'">'.$user->full_name.' ('.$role[0].')</option>';
        	}
        } 
	}

	function userSelectedOption($users, $threadMembers, $idUser)
	{
		foreach($users as $user){
			if($user->id != $idUser){
				$selected 	= '';
	        	$role 		= $user->roles->pluck('name')->toArray();
				foreach($threadMembers as $member){
					if($member->user_id == $user->id){
						$selected 	= 'selected';
					}
				}
	            echo '<option '.$selected.' value="'.$user->id.'">'.$user->full_name.' ('.$role[0].')</option>';
			}
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
			$author 	= $thr->author;
			if(($tm->thread_id == $threadID AND $tm->user_id == $userID) OR $author == $userID){
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