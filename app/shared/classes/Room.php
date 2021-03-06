<?php

class Room extends Model{

    /**
     * Get all presentation, ordered by ordering, and name.
     * @return Horaire[]
     */
    public static function getAll(){
        return Model::factory(__CLASS__)
                    ->find_many();
    }

    /**
     * @static
     * @param $id
     * @return bool|Horaire
     */
    public static function getById($id){
        return Model::factory(__CLASS__)->find_one($id);
    }
    /**
     * @static
     * @return Horaire
     */
    public static function create(){
        return Model::factory(__CLASS__)->create();
    }

    /**
     * @return array[]
     */
    public static function getAllAssoc(){
        $assoc = array();
        $all = self::getAll();
        foreach($all as $room){
            $assoc[$room->get('id')] = $room->get('name');
        }

        return $assoc;
    }

}
