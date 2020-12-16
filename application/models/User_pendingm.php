<?php

class User_pendingm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getPending()
    {
        $this->db->where('uploaded_by', $this->session->useridlead);
        return $this->db->get('clients_files');
    }

    public function updateFile($data)
    {
        $this->db->set('encrypt', $data['encrypt']);
        $this->db->set('file', $data['file']);
        $this->db->set('type', $data['type']);
        $this->db->where('id', $data['id']);
        $this->db->where('uploaded_by', $data['uploaded_by']);
        $this->db->update('clients_files');
        return $this->db->affected_rows() > 0;
    }

    public function getIdentity()
    {
        $this->db->select('orig_name,upload_date');
        $this->db->where('uploaded_by', $this->session->userid);
        $query = $this->db->get('identity_doc');

        return $query;
    }

    public function getEmployment()
    {
        $this->db->select('orig_name,upload_date');
        $this->db->where('uploaded_by', $this->session->userid);
        $query = $this->db->get('employment_doc');

        return $query;
    }

    public function getFileName($id, $id_lead)
    {
        $this->db->where('uploaded_by', $id_lead);
        $this->db->where('id', $id);
        $query = $this->db->get('clients_files');
        return $query->row();
    }

    public function deleteFile($id, $id_lead)
    {
        $this->db->where('uploaded_by', $id_lead);
        $this->db->where('id', $id);
        $this->db->delete('clients_files');

        return $this->db->affected_rows() > 0;
    }
}
