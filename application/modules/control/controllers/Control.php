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
        $username = $this->input->post('username');
        $username_encrypt = sha1($username);
        $password = $this->input->post('password');
        $password_encrypt = sha1($password);
        $ip_address = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Jakarta');
        $timelogin = date('Y-m-d H:i:s');

        if ($username == '' || $password == '') {
            $this->session->set_flashdata(
                'failed',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Username dan Password salah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>'
            );
            redirect('control/login');
        } else {
            $modelLogin = $this->Control_model->login($username_encrypt, $password_encrypt, $timelogin, $timelogin);
            if ($modelLogin) {
                echo "LOGIN BERHASIL";
            } else {
                $this->session->set_flashdata(
                    'failed',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username dan Password salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'
                );
                redirect('control/login');
            }
        }
    }
    function index()
    {
        if ($this->session->userdata('username')) {
            $data['title'] = 'Control | Referensi Dosen Tugas Akhir';
            $data['allImbuhan'] = $this->Control_model->getAllImbuhan();
            $data['stopword'] = $this->Control_model->getAllStopword();
            $data['session_access_user'] = $this->session->userdata('alias');
            $data['countSkripsi'] = $this->db->count_all_results('tugas_akhir');
            $data['countDosen'] = $this->db->count_all_results('dosen');
            $data['countMhs'] = $this->db->count_all_results('mahasiswa');
            $data['countIdx'] = $this->db->count_all_results('index');

            $this->load->view('control/index', $data);
        } else {
            $base_url = base_url();
            echo "<script>
            alert('SILAHKAN LOGIN TERLEBIH DAHULU');
            window.location.href = '$base_url'+'control/login';
            </script>";
        }
    }
}
