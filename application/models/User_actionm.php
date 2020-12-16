<?php

class User_actionm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function upload($data)
    {
        $this->db->insert('clients_files', $data);
        return $this->db->affected_rows() > 0;
    }

    public function get_form($form, $id_lead)
    {
        $this->db->where('form', $form);
        $this->db->where('uploaded_by', $id_lead);
        return $this->db->get('clients_files');
    }

    public function countStage($stage, $id_lead)
    {
        $this->db->where('stage', $stage);
        $this->db->where('uploaded_by', $id_lead);
        $this->db->from('clients_files');
        return $this->db->count_all_results();
    }

    public function getCurrentStages($id)
    {
        $this->db->where('id_lead', $id);
        $this->db->where('status', 'current');
        return $this->db->get('stages');
    }

    public function getCurrentStagesNoStatus($id)
    {
        $this->db->where('id_lead', $id);
        $this->db->where('switch', 1);
        return $this->db->get('stages');
    }

    public function getCurrentStagesSpecific($id, $stage)
    {
        $this->db->where('id_lead', $id);
        $this->db->where('stage', $stage);
        $this->db->where('switch', 1);
        return $this->db->get('stages');
    }

    public function updateClientsInfo($data, $id_lead, $tbl)
    {
        $this->db->set($data);
        $this->db->where('id_lead', $id_lead);
        $this->db->update($tbl);
        return $this->db->affected_rows() > 0;
    }

    public function checkCurrentPassword($id, $data)
    {
        $this->db->where('id_lead', $id);
        $query = $this->db->get('clients');
        $row = $query->row_array();

        $hashed = $row ? $row['client_pass'] : '';
        if (password_verify($data, $hashed))
            return true;
        return false;
    }

    public function changeEmployeePassword($id, $new)
    {
        $this->db->where('id_lead', $id);
        $this->db->set('client_pass', $new);
        $this->db->update('clients');
        return $this->db->affected_rows() > 0;
    }
}
