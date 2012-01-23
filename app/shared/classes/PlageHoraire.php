<?php

class PlageHoraire extends Model{

    /**
     * Get all presentation, ordered by ordering, and name.
     * @return PlageHoraire[]
     */
    public static function getAll(){
        return Model::factory(__CLASS__)
                    ->order_by_asc('event_day_id')
                    ->order_by_asc('start_hour')
                    ->order_by_asc('start_minute')
                    ->find_many();
    }

    /**
     * @static
     * @param $id
     * @return bool|PlageHoraire
     */
    public static function getById($id){
        return Model::factory(__CLASS__)->find_one($id);
    }
    /**
     * @static
     * @return PlageHoraire
     */
    public static function create(){
        return Model::factory(__CLASS__)->create();
    }

    public function getEventDay(){
        return EventDay::getById($this->get('event_day_id'));
    }

    /**
     * @return array[]
     */
    public static function getAllAssoc(){
        $assoc = array();
        $all = self::getAll();
        foreach($all as $plage){
            $assoc[$plage->get('id')] = $plage->getName();
        }

        return $assoc;
    }

    public function getName(){
        return $this->getEventDay()->getName() . " - " . $this->getStartTime() . " @ " . $this->getEndTime();
    }

    public function getStartTime(){
        return $this->get('start_hour') . ":" . $this->get('start_minute');
    }

    public function getEndTime(){
        return $this->get('end_hour') . ":" . $this->get('end_minute');
    }

}
