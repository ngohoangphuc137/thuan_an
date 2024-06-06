<?php
namespace App\Models;

class LoginRegisterModel extends BaseModel
{
    public function checkExist($email)
    {
        $sql = "SELECT COUNT(*) AS `count` FROM `user` WHERE user.Email = ?";
        $this->setQuery($sql);
        return $this->loadRow([$email]);
    }
    public function insertRegister($name_user, $Email, $password)
    {
        $sql = "INSERT INTO `user`(`name_user`, `Email`, `password`) VALUES (?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$name_user, $Email, $password]);
    }
    public function selectUser($Email,$password){
        $sql = "SELECT * FROM `user` WHERE user.Email =? AND user.password =?";
        $this->setQuery($sql);
        return $this->loadRow([$Email,$password]);
    }
}
?>