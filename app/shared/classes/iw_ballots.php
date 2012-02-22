<?php

class iw_ballots extends Model{

    public static function getAll(){
        return Model::factory(__CLASS__)->order_by_asc('ts_start')->find_many();
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
        return Helpers::generateSlug($this->get('conference_name'));
    }

    public function getActive(){
        return Model::factory(__CLASS__)->where_lt('ts_start', time() )->where_gt('ts_end', time() )->order_by_asc('ts_start')->find_many();
    }

    public function getPrecedent(){
        return Model::factory(__CLASS__)->where_equal('archived','0')->where_lt('ts_end', time() )->order_by_desc('ts_end')->limit('0, 1')->find_many();
    }


}
