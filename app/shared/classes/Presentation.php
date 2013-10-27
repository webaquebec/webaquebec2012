<?php

class Presentation extends Model{

    /**
     * Get limited quantity of presentation, randomly selected.
     * @param $quantity int
     * @return Presentation[]
     */
    public static function getRandomSet($quantity = 1){
        return Model::factory(__CLASS__)
                    ->limit($quantity)
                    ->find_many();
    }

    /**
     * Get all presentation according to starred property, ordered by ordering, and name.
     * @param $starred boolean
     * @return Presentation[]
     */
    public static function getAccordingToStarred($starred = TRUE){
        return Model::factory(__CLASS__)
                    ->where('starred', $starred)
                    ->order_by_asc('ordering')
                    ->order_by_asc('conference_name')
                    ->find_many();
    }

    /**
     * Get all presentation, ordered by ordering, and name.
     * @return Presentation[]
     */
    public static function getAll(){
        return Model::factory(__CLASS__)
                    ->order_by_asc('ordering')
                    ->order_by_asc('conference_name')
                    ->find_many();
    }

    /**
     * @static
     * @param $id
     * @return bool|Presentation
     */
    public static function getById($id){
        return Model::factory(__CLASS__)->find_one($id);
    }
    /**
     * @static
     * @return Presentation
     */
    public static function create(){
        return Model::factory(__CLASS__)->create();
    }

    public function getTitleSlug(){
        return Helpers::generateSlug($this->get('conference_name'));
    }

    /**
     * @return array[]
     */
    public static function getAllAssoc(){
        $assoc = array();
        $all = self::getAll();
        foreach($all as $pres){
            $assoc[$pres->get('id')] = $pres->get('conference_name');
        }

        return $assoc;
    }

}
