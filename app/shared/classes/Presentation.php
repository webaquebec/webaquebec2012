<?php

class Presentation extends Model{

    public static function getAll(){
        return Model::factory(__CLASS__)->order_by_asc('ordering')->find_many();
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

}
