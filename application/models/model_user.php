<?php 
date_default_timezone_set('Asia/Karachi');
class model_user extends CI_Model {

	

	public function __construct()	

	{
		  $this->load->database();
	}

	public function AddEditUser(
								$isPlayerExist,
							 	$isPlayerexistButNotInUser,
							 	$isPlayerExistInUser,
							 	$isPlayerExistInUserSameEmail,
							 	$isUpdate ='0'
							 )
	{
		$user_id = $this->session->userdata('user_id');
		$full_playerid      = $this->input->post('txt_playerid');
		$playerid 			= substr($full_playerid ,0, 8);
		$txt_email 			= $this->input->post('txt_Email');
		$txt_fname 			= $this->input->post('txt_fname');
		$txt_lname 			= $this->input->post('txt_lname');
		$sel_payment_platform = $this->input->post('sel_payment_platform');
		$txt_payment_username = $this->input->post('txt_payment_username');
		$sel_country		= $this->input->post('sel_country');
		$sel_state 			= $this->input->post('sel_state');
		$txt_city 			= $this->input->post('txt_city');
		$txt_password 		= $this->input->post('txt_password');
		$txt_cpassword 		= $this->input->post('txt_cpassword');
		$is_change_password = $this->input->post('is_change_password');
		    	
		if($isUpdate == 0)	    
		{
			$data['id']         	=  $this->GetLastUserID() > 0 ? $this->GetLastUserID() + 1 : 1; // $a > 15 ? 20 : 5;
		
			$data['playerid']       = $playerid ;
		}

		$data['firstname']      = $txt_fname ;
		$data['lastname']       = $txt_lname;
		$data['email']          = $txt_email;
		$data['paymentproviderid'] = $sel_payment_platform;
		$data['paymentusername']   = $txt_payment_username ;

		$data['state']         = $sel_state;
		$data['country']       = $sel_country;
		$data['city']          = $txt_city ;

		if($isUpdate == 0 || ($isUpdate == 1 && $is_change_password == 1))	    
		{
			$data['password']      = md5($txt_password);
		}
		$retunr_val = false;
		//die();

		if($isUpdate == 0)
		{
			if($isPlayerExistInUserSameEmail > 0)
			{
				$this->db->where('email', $txt_email);
				//$this->db->where('playerid', $txt_playerid);
				$this->db->update('user', $data);
				$retunr_val = true;

			}
			else
			{
				if($isPlayerExist == 0)
				{
					$p_data['fullplayerid'] = $full_playerid;
					$p_data['id'] 			= $playerid; 
					$this->db->insert('player',$p_data);
				}
					
				if($this->db->insert('user',$data))
				{
					
					
					
					$retunr_val = true;
				}
			}
		}
		else
		{
			$this->db->where('id', $user_id);
			//$this->db->where('playerid', $txt_playerid);
			$this->db->update('user', $data);
			$retunr_val = true;
		}
		
		return $retunr_val;
		
		
	}

	public function GetLastUserID()
	{
		$query  = $this->db->query(" 	
  									SELECT MAX(u.id) as last_id
  									FROM user u
								");
		$result = $query->result_array();		
		
		return $result[0]['last_id'];
	}

	public function VerifyUser()
	{
		$txt_email              = $this->input->post('txt_email');
		$txt_password 			= $this->input->post('txt_password');

		

		$query = "
					SELECT *
					FROM user u
					where email = ".$this->db->escape($txt_email)."  
					AND password = ".$this->db->escape(md5($txt_password)) 
				;
		;
		$result = $this->db->query($query)->result_array();		
		
		return $result;

	}
    
    public function getPlayerIDFromUserAndPlayerTable($txt_playerid, $txt_email)
    {
    	$txt_playerid = substr($txt_playerid ,0, 8);
    	$query = "
    				select 
					(
					    select COUNT(*)
					    from player p
					    where p.id = '$txt_playerid'
					)as isPlayerExist,
					(
					    select COUNT(*)
					    from player p
					    where p.id = '$txt_playerid'
					    AND 
					    (
					        SELECT COUNT(*)
					        from user u 
					        where u.playerid = p.id
					    )=0
					) as isPlayerexistButNotInUser,
					(
					    select count(*)
					    from user u 
					    where u.playerid = '$txt_playerid'
					  
					) as isPlayerExistInUser,
					(
					    select count(*)
					    from user u 
					    where u.playerid = '$txt_playerid'
					    and u.email = '$txt_email'
					  
					) as isPlayerExistInUserSameEmail

    			";
    	$result = $this->db->query($query)->result_array();		
		
		return $result;
    }

    public function GetLeaderboardDetails()
	{
		$WhereCondition = "";
		$query  = $this->db->query(" 	
									SELECT 
									rosterid,
									playername,
									division,
									(
									    SELECT dd.divisionname
									    FROM divisiondetails dd
									    WHERE dd.id = Leaderboard.Division
									) as divisionname, 
									avgpoints, 
									wins, 
									losses, 
									gamesplayed, 
									points, 
									avgscore, 
									opponentavgscore, 
									gamesremaining, 
									points + (gamesremaining * 3) AS potentialpoints 
									FROM GTMTheLeague.Leaderboard
									ORDER BY points DESC
									");
		
		$result = $query->result_array();			
		return $result;
	}
	public function GetLeagueScheduleDetails($WhereCondition = "")
	{
		
		$query  = $this->db->query(" 	
									SELECT id,
									Week, 
									Division, 
									 (
									    SELECT dd.divisionname
									    FROM divisiondetails dd
									    WHERE dd.id = cseventscheduleview.Division
									) as divisionname,
									'' as playeridhome, 
									'' as playeridaway, 
									home, 
									away, 
									course, 
									winner, 
									contesttime, 
									ParHme, 
									GSPHme, 
									ParAwy, 
									GSPAwy, 
									pointsadded 
									FROM GTMTheLeague.cseventscheduleview
									where 1=1 
									$WhereCondition;
									");
		
		$result = $query->result_array();
				
		return $result;
	}

	public function getAllDivisions()
	{
		$query = "
		     		select *
		     		from divisiondetails d
		     		where divisionname	 in ('Bronze', 'Gold', 'Noonan', 'Purple', 'Silver', 'Spackler', 'Webb')
				";
		$result = $this->db->query($query)->result_array();			
		return $result;

	}

	public function Get5BestMatches()
	{
		$query = "	
					SELECT -- eventscheduleid,
					playerid,
					name, 
					opponent, 
					course, 
					frontgtpar, 
					backgtpar, 
					-- gtparscore,
					(frontgsp + backgsp) AS GSP, 
					(frontholeouts + backholeouts) AS holeouts 
					from stats WHERE 1=1 
					-- gtparscore IS NOT NULL
					GROUP BY playerid -- eventscheduleid;
				";
	    $result = $this->db->query($query)->result_array();			
		return $result;
	} 

	public function Get5BestMatchesAverage()
	{
		$query = '
					SELECT eventname, 
					/*-- AVG(gtparscore),*/ 
					AVG(frontgsp + backgsp) as 18gtpar, 
					AVG(frontholeouts + backholeouts)  as 18gsp,
					AVG(backgtpar) as backgtpar,
					AVG(frontgtpar) as frontgtpar, 
					AVG(frontdifferential + backdifferential) as differential
					from stats WHERE 1=1 /* gtparscore IS NOT NULL*/
					GROUP BY eventname;
				';
		 $result = $this->db->query($query)->result_array();			
		return $result;
	}
	
}