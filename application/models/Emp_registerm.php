<?php

class Emp_registerm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function emp_register($data)
    {
        $this->db->insert('clients', $data);
        return $this->db->affected_rows() > 0;
    }

    public function getLeadTable()
    {
        $this->db->select('*');
        $this->db->from('lead_table');
        $this->db->join('clients', 'clients.id_lead = lead_table.id', 'left');
        $this->db->order_by('lead_table.imported_date', 'DESC');
        return $this->db->get();
    }

    public function checkLatestStatus($id)
    {
        $this->db->select('type'); //status
        $this->db->where('id', $id);
        return $this->db->get('lead_payment');
    }

    public function getPaymentTable()
    {
        return $this->db->query('SELECT * FROM lead_payment INNER JOIN lead_table ON lead_table.id = lead_payment.id LEFT JOIN clients ON lead_payment.id = clients.id_lead');
    }

    public function getPaymentTableProfile($id)
    {
        return $this->db->query('SELECT * FROM lead_payment INNER JOIN clients ON clients.id_lead = lead_payment.id AND clients.id_lead =' . $id);
    }

    public function deDup($data)
    {
        $this->db->where('campaign_id', $data['campaign_id']);
        $this->db->where('email', $data['email']);
        $query = $this->db->get('lead_table');
        return $query->num_rows();
    }

    public function lead_register($data)
    {
        $this->db->insert_batch('lead_table', $data);
        return $this->db->affected_rows() > 0;
    }

    public function deleteRegisteredAndAttended()
    {
        $this->db->query('DELETE FROM lead_table WHERE id NOT IN(SELECT id FROM lead_payment)');
        return $this->db->affected_rows() > 0;
    }

    public function checkHash($hash)
    {
        $this->db->where('hash', $hash);
        $query = $this->db->get('lead_table');
        return $query->num_rows();
    }

    public function updateStatusToAttended($hash, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('hash', $hash);
        return $this->db->update('lead_table');
    }

    public function updateLoa($data)
    {
        //dito nahinto
        $this->db->set('encrypt', $data['encrypt']);
        $this->db->set('file', $data['file']);
        $this->db->set('type', $data['type']);
        $this->db->set('upload_date', $data['upload_date']);
        $this->db->where('id', $data['id']);
        return $this->db->update('clients_files');
    }

    public function resetLoa($id, $id_lead)
    {
        $this->db->set('encrypt', '');
        $this->db->set('file', '');
        $this->db->set('type', '');
        $this->db->set('upload_date', '');
        $this->db->where('id', $id);
        $this->db->where('uploaded_by', $id_lead);
        return $this->db->update('clients_files');
    }
}
