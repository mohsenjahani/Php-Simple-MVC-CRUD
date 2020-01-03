<?php

use lib\Utils\Config;
use lib\Utils\Response\Response;
use lib\Utils\Utils;
use lib\Utils\Validate\Validate;
use models\Post;

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 */
class Api extends BaseApi
{
    function index()
    {
//        $post = Post::get(1);
//        return Response::successResponse($post->toJson());
    }

    function get($id = false){
        $post = Post::get($id);
        if($post)
            return Response::successResponse($post->toJson());
        return Response::errorResponse("");
    }

    /**
     * Params: title and text in json body
     */
    function add(){
        $title = $this->getJsonBodyObj('title');
        $text = $this->getJsonBodyObj('text');

        if(empty($title) || empty($text)){
            return Response::errorResponse("title and text is required.");
        }

        $post = new Post();
        $post->title = $title;
        $post->text = $text;
        $post->save();

        if($post)
            return Response::successResponse($post->toJson(), "Successfully added.");
        return Response::errorResponse("");
    }

    /**
     * Params: id, title and text in json body
     */
    function update(){
        $id = $this->getJsonBodyObj('id');
        $title = $this->getJsonBodyObj('title');
        $text = $this->getJsonBodyObj('text');

        if(empty($id) || empty($title) || empty($text)){
            return Response::errorResponse("id, title and text is required.");
        }

        $post = Post::get($id);
        $post->title = $title;
        $post->text = $text;
        $post->save();

        if($post)
            return Response::successResponse($post->toJson(), "Successfully updated.");
        return Response::errorResponse("");
    }

    /**
     * getAll posts
     */
    function getAll(){
        $posts = Post::getAll();

        if($posts)
            return Response::successResponse($posts);
        return Response::errorResponse("");
    }


    function delete($id = false){
        if(!$id) return null;
        $post = Post::delete($id);
        if($post)
            return Response::successResponse(null, "Successfully deleted.");
        return Response::errorResponse("");
    }


}