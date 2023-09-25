<?php
    function setting() {
        $ci = get_instance();
        $ci->load->database();

        $data = $ci->db->query("SELECT * FROM setting");
        return $data->row();
    }
?>