<?php

class Presentation extends Model{

    public static function getAll(){
        return Model::factory(__CLASS__)->order_by_asc('ordering')->find_many();
    }

    public static function getById($id){
        return Model::factory(__CLASS__)->find_one($id);
    }

    public function getTitleSlug(){
        return Helpers::generateSlug($this->get('conference_name'));
    }

}
