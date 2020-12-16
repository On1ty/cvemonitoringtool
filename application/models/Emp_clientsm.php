<?php

class Emp_clientsm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getClients($id = null)
    {
        return $this->db->query('SELECT * FROM clients INNER JOIN clients_info ON clients.id_lead = clients_info.id_lead WHERE created_by=' . $id . ' AND (clients.id_lead IN (SELECT id FROM lead_payment WHERE `type` = 4))');
    }

    public function getClientsByStage($stage)
    {
        return $this->db->query('SELECT * FROM `clients` INNER JOIN stages ON clients.id_lead = stages.id_lead INNER JOIN employee ON clients.created_by = employee.emp_id WHERE stages.status = "current" AND stages.stage = "' . $stage . '" AND (clients.id_lead IN (SELECT id FROM lead_payment WHERE `type` = 4))');
    }

    public function updatePass($id, $pass_hashed)
    {
        $this->db->set('client_pass', $pass_hashed);
        $this->db->where('id_lead', $id);
        $this->db->update('clients');
    }

    public function updateUsersPass($id, $pass_hashed)
    {
        $this->db->set('emp_pass', $pass_hashed);
        $this->db->where('emp_id', $id);
        $this->db->update('employee');
    }

    public function clientsProfile($id)
    {
        $this->db->from('clients');
        $this->db->join('clients_info', "clients.id_lead = clients_info.id_lead", 'left');
        $this->db->where('clients.id_lead', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function clientsFile($id, $stage)
    {
        $this->db->where('uploaded_by', $id);
        $this->db->where('stage', $stage);
        return $this->db->get('clients_files');
    }

    public function totalAdminPayment($id)
    {
        $this->db->where('id', $id);
        $this->db->where('type', 4);
        $this->db->select_sum('amount');
        return $this->db->get('lead_payment')->row()->amount;
    }

    public function usersEmail($id)
    {
        $this->db->where('emp_id', $id);
        $this->db->select('emp_name, emp_last');
        return $this->db->get('employee')->row();
    }
}
