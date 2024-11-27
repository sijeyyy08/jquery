<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Information extends Controller {

    public function __construct() {

        parent:: __construct();
        $this->call->model('information_model');
    }
	
    public function read() {

        $data ['information'] = $this->information_model->read();
        $data ['name'] = "LavaLust Framework";
        $this->call->view('info/display', $data);
    }

    public function create() {

        if($this->form_validation->submitted()) {
            
            if($this->form_validation->run()) {
                $last_name = $this->io->post('lname');
                $first_name = $this->io->post('fname');
                $email = $this->io->post('email');
                $gender = $this->io->post('gender');
                $address = $this->io->post('address');

                if($this->information_model->create($last_name, $first_name, $email, $gender, $address)) {
                    //success message
                    set_flash_alerts('success', 'Information was added successfully');
                    redirect('info/add');
                }

            } else{
                //error message
                set_flash_alerts('danger', $this->form_validation->errors());
                redirect('info/add');
            }

           
        }
        $this->call->view('info/create');
    }

    public function update($id) {
        if($this->form_validation->submitted()) {
            
            if($this->form_validation->run()) {
                $last_name = $this->io->post('lname');
                $first_name = $this->io->post('fname');
                $email = $this->io->post('email');
                $gender = $this->io->post('gender');
                $address = $this->io->post('address');

                if($this->information_model->update($last_name, $first_name, $email, $gender, $address, $id)) {
                    //success message
                    set_flash_alerts('success', 'Information was updated successfully');
                    redirect('info/read');
                }

            } else{
                //error message
                set_flash_alerts('danger', $this->form_validation->errors());
                redirect('info/read');
            }
        }
        $data['ui'] = $this->information_model->get_one($id);
        $this->call->view('info/update', $data);
    }

    public function delete($id) {
        if($this->information_model->delete($id)) {
            set_flash_alerts('success', 'Information was deleted successfully');
            redirect('info/read');
        }else{
            set_flash_alerts('danger', 'Something went wrong');
            redirect('info/read');
        }
    }
}
?>
