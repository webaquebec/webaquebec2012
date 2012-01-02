<?php

class Presentation{

    private static $select_fields = "  uid,
                                       ordering,
                                       starred,
                                       presenter_name,
                                       presenter_image,
                                       presenter_resume,
                                       conference_name,
                                       conference_resume,
                                       conference_goals,
                                       tags,
                                       website,
                                       twitter_handle";

    public static function getAll(){
        $fields=  self::$select_fields;
        $sql = "

        SELECT  {$fields}

          FROM presentation
      ORDER BY ordering ASC

          ;

        ";
        $rs = ApplicationDatabase::getDBConnection()->query($sql);

        $presentations = array();

        while(($row = $rs->assocOne()) !== FALSE){
            $p = new Presentation();
            $p->feedFromRow($row);

            $presentations[] = $p;
        }

        return $presentations;
    }

    public static function getById($id){
        $fields=  self::$select_fields;
        $sql = "

        SELECT  {$fields}

          FROM presentation
         WHERE uid = %d

          ;

        ";
        $rs = ApplicationDatabase::getDBConnection()->query($sql, array($id));

        $row = $rs->assocOne();
        if(empty($row)){
            return FALSE;
        }

        $p = new Presentation();
        $p->feedFromRow($row);

        return $p;
    }

    private $uid;
    private $ordering;
    private $starred;
    private $presenter_name;
    private $presenter_resume;
    private $presenter_image;
    private $conference_name;
    private $conference_resume;
    private $conference_goals;
    private $tags;
    private $website;
    private $twitter_handle;

    private function __construct(){

    }

    private function feedFromRow($row){
        foreach($row as $k=>$v){
            $this->$k = $v;
        }
    }

    public function getTitleSlug(){
        return Helpers::generateSlug($this->getConferenceName());
    }

    public function setConferenceGoals($conference_goals){
        $this->conference_goals = $conference_goals;
    }

    public function getConferenceGoals(){
        return $this->conference_goals;
    }

    public function setConferenceName($conference_name){
        $this->conference_name = $conference_name;
    }

    public function getConferenceName(){
        return $this->conference_name;
    }

    public function setConferenceResume($conference_resume){
        $this->conference_resume = $conference_resume;
    }

    public function getConferenceResume(){
        return $this->conference_resume;
    }

    public function setOrdering($ordering){
        $this->ordering = $ordering;
    }

    public function getOrdering(){
        return $this->ordering;
    }

    public function setPresenterResume($presenter_resume){
        $this->presenter_resume = $presenter_resume;
    }

    public function getPresenterResume(){
        return $this->presenter_resume;
    }

    public function setTags($tags){
        $this->tags = $tags;
    }

    public function getTags(){
        return $this->tags;
    }

    public function setTwitterHandle($twitter_handle){
        $this->twitter_handle = $twitter_handle;
    }

    public function getTwitterHandle(){
        return $this->twitter_handle;
    }

    public function setUid($uid){
        $this->uid = $uid;
    }

    public function getUid(){
        return $this->uid;
    }

    public function setWebsite($website){
        $this->website = $website;
    }

    public function getWebsite(){
        return $this->website;
    }

    function __call($name, $arguments){
        throw new Exception("Bad function name : $name.");
    }

    public function __get($name){
        throw new Exception("Bad property name : $name.");
    }

    public function setPresenterImage($presenter_image){
        $this->presenter_image = $presenter_image;
    }

    public function getPresenterImage(){
        return $this->presenter_image;
    }

    public function setStarred($starred){
        $this->starred = $starred;
    }

    public function getStarred(){
        return $this->starred;
    }

    public function getPresenterName(){
        return $this->presenter_name;
    }

    public function setPresenterName($presenter_name){
        $this->presenter_name = $presenter_name;
    }
}
