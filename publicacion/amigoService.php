<?php

class AmigoServices
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }

    public function GetUserFriends($userId)
    {
        $userFriends = array();
        $stmt = $this->Context->Db->prepare("SELECT u.* FROM users u INNER JOIN amigos a ON u.id = a.amigo_id WHERE a.usuario_id = ?");
        $stmt->bind_param('s', $userId);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return $userFriends;
        } else {
            while ($row = $resul->fetch_object()) {
                $userFriends[] = new Usuario($row->id, $row->nombre, $row->apellido, '', '', $row->usuario, '');
            }
            return $userFriends;
        }
        $stmt->close();
    }

    private function GetByUserName($userName)
    {
        $user = array();
        $stmt = $this->Context->Db->prepare("SELECT id FROM `users` WHERE usuario = ?");
        $stmt->bind_param('s', $userName);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows !== 0) {
            $user = $resul->fetch_object();
            $stmt->close();
            return $user->id;
        }
        
    }

    public function Add($userId, $friendUserName)
    {
        $friendId = $this->GetByUserName($friendUserName);

        if (empty($friendId)) {
            return false;
        }

        $stmt = $this->Context->Db->prepare("INSERT INTO `amigos` VALUES (?,?)");
        $stmt->bind_param('ss', $userId, $friendId);
        $stmt->execute();
        $stmt->close();
    }





    public function Delete($userId, $userFriendId)
    {
        $stmt = $this->Context->Db->prepare("DELETE FROM `amigos` WHERE usuario_id = ? AND amigo_id = ?");
        $stmt->bind_param('ss', $userId, $userFriendId);
        $stmt->execute();
        $stmt->close();
    }
}
