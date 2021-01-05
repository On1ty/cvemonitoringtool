<?php

class Admin_actionm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function approve($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows() > 0;
    }

    public function deny($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows() > 0;
    }

    public function deletePayment($hash)
    {
        $this->db->where('hash_payment', $hash);
        $this->db->delete('lead_payment');
        return $this->db->affected_rows() > 0;
    }

    public function remove_client($id_lead){
        $this->db->where('id_lead', $id_lead);
        $this->db->delete('stages');
        $this->db->where('id_lead', $id_lead);
        $this->db->delete('clients');
        $this->db->where('id_lead', $id_lead);
        $this->db->delete('clients_info');
        return $this->db->affected_rows() > 0;
    }

    public function editPayment($hash, $data)
    {
        $this->db->set('type', $data['type']);
        $this->db->set('amount', $data['amount']);
        $this->db->set('date_paid', $data['date_paid']);
        $this->db->set('remarks', $data['remarks']);
        $this->db->set('paid_by', $data['paid_by']);
        $this->db->where('hash_payment', $hash);
        $this->db->update('lead_payment');
        return $this->db->affected_rows() > 0;
    }

    public function acceptOrUndoDocuments($id, $stage, $status, $date)
    {
        $this->db->set('status', $status);
        $this->db->set('date_completed', $date);
        $this->db->where('id_lead', $id);
        $this->db->where('stage', $stage);
        $this->db->update('stages');
        return $this->db->affected_rows() > 0;
    }

    public function clientsFile($id, $stage)
    {
        $this->db->where('stage', $stage);
        $this->db->where('uploaded_by', $id);
        return $this->db->get('clients_files');
    }

    public function uploadEnrollment($data, $doc)
    {
        $this->db->where('doc', $doc);
        $query = $this->db->get('clients_files');

        if ($query->num_rows() > 0) {
            return false;
        }

        $this->db->insert('clients_files', $data);
        return $this->db->affected_rows() > 0;
    }
}
