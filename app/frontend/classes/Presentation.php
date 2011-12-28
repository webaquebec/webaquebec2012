<?php

class Presentation{

    public static function getAll(){
        $sql = "

        SELECT
                uid,
                ordering,
                presenter_name_first,
                presenter_name_last,
                presenter_resume,
                conference_name,
                conference_resume,
                conference_goals,
                tags,
                website,
                twitter_handle

          FROM  presentation

          ;

        ";
        $rs = ApplicationDatabase::getDBConnection()->query($sql);
        return $rs->assocAll();
    }

}
