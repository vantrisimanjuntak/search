<?php class Control extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('control/Control_model');
    }
    function login()
    {
        $data['title'] = 'Login';
        $this->load->view('control/login_control_view', $data);
    }
    function checklogin()
    {
        $data['title'] = 'Login';
        $username = sha1($this->input->post('username'));
        $password = sha1($this->input->post('password'));
        $ip_address = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Jakarta');
        $timelogin = date('Y-m-d H:i:s');

        if ($username == NULL || $password == NULL) {
            $baseurl = base_url();
            echo "<script>
            alert('USERNAME ATAU PASSWORD KOSONG');
            window.location.href = '$baseurl'+'control/login';
            </script>";
        } else {
            $query = $this->Control_model->login($username, $password, $ip_address);
            if ($query) {
                redirect('control');
            } else {
                $this->session->set_flashdata(
                    'failed',
                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Username dan Password salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'
                );
                $this->load->view('control/login_control_view', $data);
            }
        }
    }
}
