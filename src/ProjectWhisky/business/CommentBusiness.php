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
    
    
    public function showComments($whiskyId) 
    {
        $commentDAO = new CommentDAO();
        $commentList = $commentDAO->getCommentByWhisky($whiskyId);
        return $commentList;
    }
    public function createComment($whiskyid)
    {

    }
}