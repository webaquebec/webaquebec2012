<?php

class EventDay extends Model{

    /**
     * Get all presentation, ordered by ordering, and name.
     * @return EventDay[]
     */
    public static function getAll(){
        return Model::factory(__CLASS__)
//                    ->order_by_asc('ordering')
//                    ->order_by_asc('conference_name')
                    ->find_many();
    }

    /**
     * @static
     * @param $id
     * @return bool|EventDay
     */
    public static function getById($id){
        return Model::factory(__CLASS__)->find_one($id);
    }
    /**
     * @static
     * @return EventDay
     */
    public static function create(){
        return Model::factory(__CLASS__)->create();
    }

    public function getName(){
        return date('Y-m-d', strtotime($this->get('date')));
    }

}
