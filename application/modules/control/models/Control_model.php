<?php class Control_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function login($username, $password, $timelogin, $ip_address)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
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
}
