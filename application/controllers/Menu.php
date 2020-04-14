<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Menu Management";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['menu'] = $this->menu->getSubMenu();

            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("menu/index", $data);
            $this->load->view("templates/footer");
        } else {
            $data = [
                'menu' => $this->input->post('menu', true),
            ];
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {

        $this->form_validation->set_rules('menuId', 'MenuId', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "SubMenu Management";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['submenu'] = $this->menu->getSubMenu();

            $this->load->view("templates/header", $data);
            $this->load->view("templates/sidebar", $data);
            $this->load->view("templates/topbar", $data);
            $this->load->view("menu/submenu", $data);
            $this->load->view("templates/footer");
        } else {
            $data = [
                'menu_id' => $this->input->post('menuId', true),
                'title' => $this->input->post('title', true),
                'url' => $this->input->post('url', true),
                'icon' => $this->input->post('icon', true),
                'is_active' => $this->input->post('isActive', true),
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }
}
