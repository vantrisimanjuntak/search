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
                redirect('control/index');
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
            // $data['allImbuhan'] = $this->Control_model->getAllImbuhan();
            // $data['stopword'] = $this->Control_model->getAllStopword();
            $data['session_access_user'] = $this->session->userdata('alias');
            // $data['countSkripsi'] = $this->db->count_all_results('tugas_akhir');
            // $data['countDosen'] = $this->db->count_all_results('dosen');
            // $data['countMhs'] = $this->db->count_all_results('mahasiswa');
            // $data['countIdx'] = $this->db->count_all_results('index');

            $this->load->view('control/index', $data);
        } else {
            $base_url = base_url();
            echo "<script>
            alert('SILAHKAN LOGIN TERLEBIH DAHULU');
            window.location.href = '$base_url'+'control/login';
            </script>";
        }
    }
    function imbuhan()
    {
        if ($this->session->userdata('username')) {
            $data['title'] = 'Control | Portal Tugas Akhir';
            $data['allImbuhan'] = $this->Control_model->getAllImbuhan();
            $data['session_access_user'] = $this->session->userdata('alias');
            $this->load->view('control/imbuhan', $data);
        }
    }
    function checkKataImbuhan()
    {
        $kata_imbuhan = $this->input->post('kata_imbuhan');
        $kata_dasar = $this->input->post('kata_dasar');

        if ($kata_imbuhan != '' && $kata_dasar != '') {
            $checkKataImbuhan = $this->Control_model->checkKataImbuhan($kata_imbuhan, $kata_dasar);
        }
    }
    function addImbuhan()
    {
        if ($this->session->userdata('username')) {
            $kata_imbuhan = strtolower($this->input->post('kata_imbuhan'));
            $kata_dasar = strtolower($this->input->post('kata_dasar'));

            if ($kata_dasar == '' || $kata_imbuhan == '') {
                $this->session->set_flashdata(
                    'failed',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   Form ada yang kosong!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'
                );
                redirect('control/imbuhan');
            } else if ($kata_dasar == '' && $kata_imbuhan == '') {
                $this->session->set_flashdata(
                    'failed',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   Form ada yang kosong!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'
                );
                redirect('control/imbuhan');
            } else {
                $input = $this->Control_model->addImbuhan($kata_imbuhan, $kata_dasar);
                if ($input) {
                    $this->session->set_flashdata('success', 'ditambahkan');
                    redirect('control/imbuhan');
                }
            }
        }
    }
    function hapusImbuhan($id)
    {
        $hapusImbuhan = $this->Control_model->hapusImbuhan($id);
        if ($hapusImbuhan == TRUE) {
            $this->session->set_flashdata('berhasil_hapus_imbuhan', ' ');
            redirect('control/imbuhan');
        }
    }
    function stopwords()
    {
        if ($this->session->userdata('username')) {
            $data['title'] = 'Control | Portal Tugas Akhir';
            $data['allStopword'] = $this->Control_model->getAllStopword();
            $data['session_access_user'] = $this->session->userdata('alias');
            $this->load->view('control/stopword_v', $data);
        } else {
            redirect('control/login');
        }
    }
    function checkStopword()
    {
        $stopword = $this->input->post('stopword');
        if ($stopword == '') {
            echo "Stopword Kosong";
        } else {
            $checkStopword = $this->Control_model->checkStopword($stopword);
            if ($checkStopword->num_rows() > 0) {
                echo "DATA SUDAH ADA";
                echo "<script>
                    $('.tambah-stopword').prop('disabled', true);
                </script>";
            }
        }
    }
    function tambahStopword()
    {
        $stopword = strtolower($this->input->post('stopword'));
        $id = bin2hex(random_bytes(4));
        $tambahStopword = $this->Control_model->tambahStopword($id, $stopword);
        if ($tambahStopword == TRUE) {
            $this->session->set_flashdata('berhasil_tambah_stopword', 'a');
            redirect('control/stopwords');
        }
    }
    function hapusStopword($id)
    {
        $hapusStopword = $this->Control_model->hapusStopword($id);
        if ($hapusStopword == TRUE) {
            $this->session->set_flashdata('berhasil_hapus_stopword', ' ');
            redirect('control/stopwords');
        }
    }
    function skripsi()
    {
        if ($this->session->userdata('username')) {
            $data['title'] = 'Control | Portal Tugas Akhir';
            $data['allSkripsi'] = $this->Control_model->getAllSkripsi();
            $data['session_access_user'] = $this->session->userdata('alias');
            $this->load->view('skripsi', $data);
        } else {
            redirect('control/login');
        }
    }
    function dosen()
    {
        if ($this->session->userdata('username')) {
            $data['title'] = 'Control | Referensi Dosen Tugas Akhir';
            $data['dosen'] = $this->Control_model->getAllDosen();
            $data['prodi'] = $this->Control_model->getAllProdi();
            $data['session_access_user'] = $this->session->userdata('alias');
            $this->load->view('dosen', $data);
        } else {
            redirect('control/login');
        }
    }
    function checknip()
    {
        $nip = $this->input->post('nip');
        if ($nip != '') {
            $this->Control_model->checknip($nip);
        } else {
            echo "NIP KOSONG";
        }
    }
}
