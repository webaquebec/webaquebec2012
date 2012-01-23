<?php

class Horaire extends Model{

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

    public function getPlageHoraire(){
        return PlageHoraire::getById($this->get('plage_horaire_id'));
    }

    public function getPresentation(){
        return Presentation::getById($this->get('presentation_id'));
    }

    public function getRoom(){
        return Room::getById($this->get('room_id'));
    }

}
