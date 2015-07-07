<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\WhiskyDAO;
use src\ProjectWhisky\data\CommentDAO;



class CommentBusiness
{
    public function showAllComments() //OM TE TESTEN!
    {
        $commentDAO = new CommentDAO();
        $commentList = $commentDAO->getAllComments();
        return $commentList;
    }


    /**
     * Show comments by whisky id
     */
    public function showComments($whiskyId) 
    {
        $commentDAO = new CommentDAO();
        $commentList = $commentDAO->getCommentByWhisky($whiskyId);
        return $commentList;
    }

    /**
     * Insert comment
     */
    public function createComment($whiskyid, $userId, $comment)
    {
        $commentDAO = new CommentDAO();
        $commentList = $commentDAO->insertNewComment($whiskyid, $userId, $comment);
        return $commentList;
    }
}