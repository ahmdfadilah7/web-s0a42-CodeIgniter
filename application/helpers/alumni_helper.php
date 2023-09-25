<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('nisn')){
        redirect('Auth');
    }else{
        $role = $ci->session->userdata('role');
        if ($role != 'Admin'){
            redirect('data_alumni');
        }
    }
}


?>