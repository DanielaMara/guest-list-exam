<?php

class GuestService 
{
    public static function listGuests() 
    {
        $db = ConnectionFactory::getDB();
        $guests = array();
        
        foreach($db->guests() as $guest) 
        {
           $guests[] = array (
               'id' => $guest['id'],
               'name' => $guest['name'],
               'email' => $guest['email']
           ); 
        }
        
        return $guests;
    }
    
    
    public static function add($newGuest)
    {
        $db = ConnectionFactory::getDB();
        $guest = $db->guests->insert($newGuest);
        return $guest;
    }
    
    
    public static function delete($id)
    {
        $db = ConnectionFactory::getDB();
        $guest = $db->guests[$id];
        
        if($guest)
        {
            $guest->delete();
            return true;
        }
        return false;
    }
}

?>