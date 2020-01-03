<?php

namespace models;

use Model;

class Post extends Model
{
    protected $id = null;
    public $title, $text;

    function save(){
        $this->id = $this->execute('REPLACE INTO post (id, title, text) VALUES (:id, :title, :text);', array(
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
        ));
    }

    /**
     * @param $id
     * @return Post
     */
    static function get($id){
        $post = Model::Instance()->getFirst('select * from post WHERE id=:id',array(
            'id' => $id,
        ));
        if(isset($post)) {
            $p = new Post();
            $p->id = $id;
            $p->title = $post['title'];
            $p->text = $post['text'];
            return $p;
        }
        return null;
    }

    /**
     * returns all post
     * @return Post[]
     */
    static function getAll(){
        $post = Model::Instance()->getData('select * from post order by id DESC');
        if(isset($post)) {
            return $post;
        }
        return null;
    }

    /**
     * delete post
     * @param $id
     * @return boolean
     */
    static function delete($id = false){
        if(!$id) return false;
        Model::Instance()->execute('delete from post where id=:id', array(
            "id" => $id
        ));
        return true;
    }

    function toJson(){
        return array(
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
        );
    }
}