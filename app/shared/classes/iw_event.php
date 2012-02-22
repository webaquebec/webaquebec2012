<?php

class iw_event extends Model{

    public static function getAll(){
        return Model::factory(__CLASS__)->order_by_asc('ts_publication')->find_many();
    }

    /**
     * @static
     * @param $id
     * @return bool|IWBallot
     */
    public static function getById($id){
        return Model::factory(__CLASS__)->find_one($id);
    }
    /**
     * @static
     * @return IWBallot
     */
    public static function create(){
        return Model::factory(__CLASS__)->create();
    }

    public function getTitleSlug(){
        return Helpers::generateSlug($this->get('article_title'));
    }

    public function getNonArchived(){
        return Model::factory(__CLASS__)->where_equal('archived','0')->order_by_asc('ts_publication')->find_many();
     }
	 
    public function getToCome(){
        return Model::factory(__CLASS__)->where_equal('archived','0')->where_lt('ts_publication', time() )->where_gt('ts_end_publication', time() )->order_by_desc('ts_publication')->find_many();
     }
	 
    public function getHasPast(){
        return Model::factory(__CLASS__)->where_equal('archived','1')->where_lt('ts_publication', time() )->where_gt('ts_end_publication', time() )->order_by_asc('ts_publication')->find_many();
	}
}