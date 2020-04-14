<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = 'SELECT a.* , b.menu
                FROM `user_sub_menu` a JOIN `user_menu` b
                ON a.menu_id = b.id
        ';
        return $this->db->query($query)->result_array();
    }
}
