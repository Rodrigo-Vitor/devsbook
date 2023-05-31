<?php 
namespace src\handlers;
use src\models\Post;
use src\models\User;
use src\models\UserRelation;

class PostHandler {
    public static function addPost($idUser, $type, $body) {
        $body = trim($body);
        if(!empty($idUser) && !empty($body)) {
            Post::insert([
                'id_user' => $idUser,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'body' => $body
            ])->execute();
        }
    }   

    public static function GetHomeFeed($idUser, $page) {
        $perPage = 2;
        //1. Pegar Lista de Usuarios que eu sigo
        $usersList = UserRelation::select()->where('user_from', $idUser=1);
        $users = [];
        foreach($usersList as $userItem) {
            $users[] = $userItem['user_to'];
        }
        $users[] = $idUser;

        //2. Pegar posts dessa galera ordenada pela data
        $postList = Post::select()
                        ->where('id_user', 'in', $users)
                        ->orderBy('created_at', 'desc')
                        ->page($page, $perPage)
                    ->get();

        $total = Post::select()
            ->where('id_user', 'in', $users)
        ->count();
        $pageCount = $total / $perPage;
                                    
        //3. Transformar o resultado em objetos do model
        $post = [];
        foreach($postList as $postItem) {
            $newPost = new Post();
            $newPost->id = $postItem['id'];
            $newPost->type = $postItem['type'];
            $newPost->created_at = $postItem['created_at'];
            $newPost->body = $postItem['body'];
            $newPost->mine = false;

            //4. preencher as informações adicionais no post
            $newUser = User::select()->where('id', $postItem['id_user'])->one();
            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['name'];
            $newPost->user->avatar = $newUser['avatar'];
                $newPost->mine = true;
            if($postItem['id_user'] == $idUser) {
                $newPost->mine = true;
            }   
            //4.1 preencher info de Likes
            $newPost->likeCount = 0;
            $newPost->liked = false;
            //4.2 preencher info de Comentarios
            $newPost->comments = [];

            $posts[] = $newPost;
        }
        //5. retornar o post
        return [
            "posts" => $posts,
            "pageCount" => ceil($pageCount),
            "currentPage" => $page
        ];
    }
}