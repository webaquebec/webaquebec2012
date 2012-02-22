<?php

class iw_ballots_votes extends Model{

    /**
     * @static
     * @return IWBallot
     */
    public static function create(){
        return Model::factory(__CLASS__)->create();
    }

	/**
		@param $id
		@param $team 
		@return bool|int vote count
	
		SELECT COUNT(*) as total FROM iw_b WHERE iw_ballotsID=$id AND iw_teamsID=$team
	*/
    public static function getVoteCount($id,$team){
		return Model::factory(__CLASS__)->where_equal('iw_ballotsID',$id)->where_equal('iw_teamsID',$team)->count();
    }
	

    public static function hasVoted($vote_id,$user_email){
		return Model::factory(__CLASS__)->where_equal('iw_ballotsID',$vote_id)->where_equal('email',$user_email)->count();
    }


}