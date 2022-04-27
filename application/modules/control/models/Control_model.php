<?php class Control_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function login($username_encrypt, $password_encrypt, $timelogin, $ip_address)
    {
        $this->db->where('username', $username_encrypt);
        $this->db->where('password', $password_encrypt);
        $queryLogin = $this->db->get('superuser');
        if ($queryLogin->num_rows() > 0) {
            foreach ($queryLogin->result_array() as $row) {
                $sess = array(
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'alias' => $row['alias']
                );
                $this->session->set_userdata($sess);
            }
            $data = array(
                'id' => bin2hex(random_bytes(4)),
                'login_id' => $row['id'],
                'time_login' => $timelogin,
                'ip_address' => $ip_address
            );
            $this->db->insert('login_time', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function getAllImbuhan()
    {
        $queryGetAllImbuhan = $this->db->get('kata_imbuhan')->result_array();
        return $queryGetAllImbuhan;
    }
    function addImbuhan($kata_imbuhan, $kata_dasar)
    {
        $this->db->select('kata_imbuhan, kata_dasar');
        $this->db->from('kata_imbuhan');
        $this->db->where('kata_imbuhan', $kata_imbuhan);
        $this->db->where('kata_dasar', $kata_dasar);
        $queryImbuhan = $this->db->get();

        if ($queryImbuhan->num_rows() > 0) {
            return FALSE;
        } else {
            $data = array(
                'id' => bin2hex(random_bytes(2)),
                'kata_imbuhan' => $kata_imbuhan,
                'kata_dasar' => $kata_dasar
            );
            $this->db->insert('kata_imbuhan', $data);
            return TRUE;
        }
    }
    function hapusImbuhan($id)
    {
        $this->db->where('id', $id);
        $checkImbuhan = $this->db->get('kata_imbuhan');
        if ($checkImbuhan->num_rows() > 0) {
            $this->db->where('id', $id);
            $this->db->delete('kata_imbuhan');
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function getAllStopword()
    {
        return $this->db->get('stopwords');
    }
}
